<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBorrowRequest;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowing = Borrow::paginate(20);
        return view('borrow.index',compact('borrowing'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('borrow.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowRequest $request, Borrow $borrow)
    {
        $borrow->create($request->validated());
        return redirect()->route('borrow.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrow $borrow)
    {
        return view('borrow.show', compact('borrow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrow $borrow)
    {
        return view('borrow.edit', compact('borrow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBorrowRequest $request, Borrow $borrow)
    {
        $borrow->update($request->validated());
        return redirect()->route('borrow.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        $borrow->delete();
        return redirect()->route('borrow.index');

    }
}
