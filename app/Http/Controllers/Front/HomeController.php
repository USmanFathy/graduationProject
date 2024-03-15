<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['category'])->active()
            ->latest()
            ->take(8)
            ->get();
        $productSlider = Product::where('featured','=',1)->paginate(15);
//        $futureCategory = Category::where('featured','=',1)->paginate(10);
        $categories = Category::with('subcategories')
            ->where('featured', 1)
            ->whereNull('parent_id')
            ->paginate(5)
        ;

        $hierarchicalCategories = [];

        foreach ($categories as $category) {
            $categoryGroup = [
                'category' => $category,
                'subcategories' => $category->subcategories
            ];

            $hierarchicalCategories[] = $categoryGroup;
        }



        return view(
            'front.home',
            [
                'products' => $products,
                'productSlider' => $productSlider,
                'hierarchicalCategories' => $hierarchicalCategories
            ]
        );
    }




}
