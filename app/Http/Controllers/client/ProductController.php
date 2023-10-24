<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $product;
    public function __construct(Product $product)
    {
        // $this->middleware('auth');
        $this->product = $product;
        // $this->size = $size;
    }
    public function index(Request $request,$category_id)
    {
        $products = $this->product->getBy($request->all(), $category_id);

        return view('client.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->product->with(['sizes'])->findOrFail($id);
        $products = $this->product->latest('id')->paginate(6);
        return view('client.products.detail', compact('product', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
