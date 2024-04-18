<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function index()
    {

        $products = QueryBuilder::for(Product::class)
            ->with('category')
            ->allowedFilters(['category.slug','name','price','author']) // Add 'q' as a custom filter if needed
            ->allowedSorts(['name', 'price'])
            ->paginate(12);

        return view('front.products.products', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->q;
        $products = Product::with('category')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
            ->orWhereHas('category', function($q) use ($query) {
                $q->where('slug', 'LIKE', "%{$query}%");
            })
            ->paginate(12);
        return view('front.products.products', compact('products'));
    }

    public function autocomplete(Request $request)
    {
        $query = $request->term;

        $results = Product::with('category')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
            ->orWhereHas('category', function($q) use ($query) {
                $q->where('slug', 'LIKE', "%{$query}%");
            })->pluck('name');

        return response()->json($results->toArray());
    }


    public function show(Product $product)
    {
        if (!$product->status =='active')
        {
            abort(404);
        }

        return view('front.products.show' , compact('product'));
    }

    public function productsFilters(Category $category)
    {
        $products = QueryBuilder::for(Product::class)
            ->with('category')
            ->whereHas('category', function ($query) use ($category) { // Filter by category name (adjust LIKE operator if needed)
                $query->where('name', 'like', '%' . $category . '%');
            })
            ->paginate(20);

//        dd($products);

//        $products = Product::with(['category'])
//            ->where('category_id','=',$category->id)
//            ->paginate(20)

        return view('front.products.products' , compact('products'));
    }
}
