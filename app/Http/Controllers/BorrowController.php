<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBorrowRequest;
use App\Models\Borrow;
use App\Models\Product;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowing = Borrow::paginate(20);
        return view('front.borrow.index',compact('borrowing'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
//        dd($product);
        return view('front.borrow.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowRequest $request, Borrow $borrow)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();
//        dd($validatedData);
        try {

            $borrow->create($validatedData);
        } catch (\PDOException $exception){
            dd($exception);
        }
//        dd($borrow);
        return redirect()->route('borrowing.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrow $borrow)
    {
        return view('front.borrow.show', compact('borrow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrow $borrow)
    {
        return view('front.borrow.edit', compact('borrow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBorrowRequest $request, Borrow $borrow)
    {
        $borrow->update($request->validated());
        return redirect()->route('borrowing.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        $borrow->delete();
        return redirect()->route('borrowing.index');

    }
}
