<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\ImportProducts;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        $products = Product::with(['category' ])->search($request->query())->paginate();

        return view('Dashboard.products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $product = new Product();
        return view('Dashboard.products.create' , compact('product' , 'categories' ));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      =>'required|string|min:3|max:255',

            'image'    =>[
                'image',
            ],
            'status' => 'in:active,archived,draft',
            'attachment' => 'required_if:type,==,pdf'
        ]);
        $request->merge([
            'slug'=>Str::slug($request->post('name')),
        ]);
        $data = $request->except('image' );
        $pdf = $request->except('attachment' );
        if ($pdf){
            $pathPdf=$this->uploadPdf($request);
            $data['attachment'] = $pathPdf;
        }
        $path=$this->uploadImage($request);

        if ($path){
            $data['image'] = $path;
        }
         Product::create($data);

        return redirect()->route('products.index')->with('success' , 'Product Created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('Dashboard.products.edit' , compact('product' , 'categories' ));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'      =>'required|string|min:3|max:255',

            'image'    =>[
                'image','max:1048576','dimensions:min_width=150 , min_height=100'
            ],
            'status' => 'in:active,archived,draft'
        ]);
        $old_image = $product->image;
        $old_attachment = $product->attachment;
        $data = $request->except('image' );
        $path=$this->uploadImage($request);
        $pdf = $request->except('attachment' );
        $pathPdf = $this->uploadPdf($request);
        if ($pdf){
            $data['attachment'] = $pathPdf;
        }

        if ($path){
            $data['image'] = $path;
        }


        $product->update($data);

        if($old_attachment && $pathPdf){
            Storage::disk('public')->delete($old_attachment);
        }

        if($old_image && $path){
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('products.index')->with('info' ,'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('danger' ,'Product Deleted!');

    }
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file =$request->file('image'); //uploaded file
        $path =$file->storeAs('Products/'.$request->name ."/images/",$file->getClientOriginalName(), 'public');

        return $path ;
    }
    protected function uploadPdf(Request $request)
    {
        if (!$request->hasFile('attachment')) {
            return;
        }
        $file =$request->file('attachment'); //uploaded file
        $path =$file->storeAs('Products/'.$request->name."/attachments/" ,$file->getClientOriginalName(), 'public');

        return $path ;
    }
    public function trash()
    {
        $request = request();
        $products = Product::onlyTrashed()->search($request->query())->paginate();
        return view('Dashboard.products.trash' , compact('products'));

    }
    public function restore(Request $request,$id)
    {
        $product= Product::onlyTrashed()->findOrFail($id);
        $product->restore($id);
        return redirect()->route('products.trash')
            ->with('success' , 'Product restored!');
    }

    public function force_delete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete($id);
        if ($product->image){
            Storage::disk('public')->deleteDirectory('Products/'.$product->name);        }

        return redirect()->route('products.trash')
            ->with('danger' , 'Product deleted forever!');
    }


}
