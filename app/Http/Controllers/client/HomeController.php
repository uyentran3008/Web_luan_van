<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $product;
    // protected $size;
    public function __construct(Product $product)
    {
        // $this->middleware('auth');
        $this->product = $product;
        // $this->size = $size;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
       
        // $products = Product::with('sizes')->get();
        // $products = Product::with('sizes')->get();
        $products = $this->product->latest('id')->paginate(4);
        
        
        
        

    

        // $productId = $this->product->findOrFail($id);
        // $product = $this->product;
        // $price = DB::table('products')
        //     ->join('product_sizes', 'products.id', '=', 'product_sizes.product_id')
        //     ->join('sizes', 'sizes.id', '=', 'product_sizes.size_id')
        //     // ->where('products.id', $product)
        //     ->select('product_sizes.price')
        //     ->first()->price;
        return view('client.home.index', compact('products'));
    }


}
