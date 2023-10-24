<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $cart;
    protected $product;
    protected $cartProduct;
    protected $coupon;
    protected $order;
    protected $size;

    public function __construct(Product $product, Cart $cart, CartProduct $cartProduct, Coupon $coupon, Order $order, Size $size)
    {
        $this->product = $product;
        $this->cart = $cart;
        $this->cartProduct = $cartProduct;
        $this->coupon = $coupon;
        $this->order = $order;
        $this->size = $size;
    }

    public function index()
    {
        // $carts = $this->cart->firtOrCreateBy(auth()->user()->id)->load('products');
        // $carts = $this->cart->firtOrCreateBy(auth()->user()->id)->load(['products']);
        // $cart = Cart::where('user_id', auth()->id())->first();
        // $cartProducts = $cart->products()->with('sizes')->get();
        // $cart = $this->cart->firtOrCreateBy(auth()->user()->id);
        // $carts = Cart::with('products', 'sizes')->where('c');
        // $cartProduct = CartProduct::with('size')->get();
        $cart = $this->cart->firtOrCreateBy(auth()->user()->id);
        // $cartTotal = $this->calculateCartTotal($cart);
        // $cartProducts = $cart ? $cart->cartProducts : [];
        return view('client.carts.index', compact('cart'));

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
        $productId = $request->input('product_id');
        $sizeId = $request->input('size_id');
       
        $product = Product::findorFail($productId);
        $size = Size::findOrFail($sizeId);
        
        if (!$size || !$product ) {
            
            return back()->with(['message' => 'Bạn chưa chọn size']);
           
        };
        
        // Find or create a cart for the current user
        // $cart = $this->cart->firtOrCreateBy(auth()->user()->id);
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        
        // Check if the product already exists in the cart
        // $existingProduct = $cart->products()
        //     ->where('product_id', $productId)
        //     ->where('size_id', $sizeId)
        //     ->first();
        
        $existingProduct = $this->cartProduct->getBy($cart->id, $productId, $sizeId);
        if ($existingProduct) {
            // If the product already exists, increment the quantity
            // $existingProduct->pivot->quantity++;
            // $existingProduct->pivot->save();
            $quantity = $existingProduct->product_quantity;
            $existingProduct->update(['product_quantity' => ($quantity + $request->product_quantity)]);

        } else {
            // Otherwise, create a new cart product
            $cart->products()->attach($product, [
                'size_id' => $size->id,
                'product_quantity' => 1
            ]);
        }
        
        // return response()->json(['message' => 'Product added to cart.']);
        return back()->with(['message' => 'Thêm thành công']);

        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    private function calculateCartTotal(Cart $cart)
    {
        $total = 0;

        foreach ($cart->products as $product) {
            $total += $product->price * $product->pivot->quantity;
        }

        return $total;
    }
}
