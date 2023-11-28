<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\CreateOrderRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Size;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        // dd(auth()->user()->id);
        // dd($this->cart);
        $carts = $this->cart->firtOrCreateBy(auth()->user()->id)->load('products');
        $coupons = Coupon::valid()->get();
        // dd($cartId);
        // $cartId = Cart::where('user_id', auth()->user()->id)->value('id');
        // dd($cartId);
        // $cartProducts = Cart::find($cartId)->cartProducts;
        // $cartId = CartProduct::find($cartProductId)->cart->id;
        // dd($cartProducts);
        // $cartProduct = CartProduct::find($cartId);
    
        
        // $cartProducts = CartProduct::where('?cart_id', $cartId)->get();
        
        // $cartProduct = $cartId->cartProducts()->find($cartProducts);
        
        return view('client.carts.index', compact(  'carts', 'coupons' ));

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
        // dd(auth()->user()->id);
        if($request->size_id) {

        $product = $this->product->findOrFail($request->product_id);
        $size = $this->size->findOrFail($request->size_id);
        $cart = $this->cart->firtOrCreateBy(auth()->user()->id);
        $cartProduct = $this->cartProduct->getBy($cart->id, $product->id, $size->id);
        if($cartProduct) {
            $quantity = $cartProduct->product_quantity;
            $cartProduct->update(['product_quantity' => ($quantity + $request->product_quantity)]);
        } else {
            $dataCreate['cart_id'] = $cart->id;
            $dataCreate['size_id'] = $request->size_id;
            $dataCreate['product_quantity'] = $request->product_quantity ?? 1;
            
            $dataCreate['product_id'] = $request->product_id;
            $this->cartProduct->create($dataCreate);
        }
        return back()->with(['message' => 'Thêm thành công']);
       } else {
        return back()->with(['message' => 'Bạn chưa chọn size']);
       }
    }


    // public function store(Request $request)
    // {
    //     $productId = $request->input('product_id');
    //     $sizeId = $request->input('size_id');
       
    //     $product = Product::findorFail($productId);
    //     $size = Size::findOrFail($sizeId);
        
    //     if (!$size || !$product ) {
            
    //         return back()->with(['message' => 'Bạn chưa chọn size']);
           
    //     };
        
    //     // Find or create a cart for the current user
    //     // $cart = $this->cart->firtOrCreateBy(auth()->user()->id);
    //     $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        
    //     // Check if the product already exists in the cart
    //     // $existingProduct = $cart->products()
    //     //     ->where('product_id', $productId)
    //     //     ->where('size_id', $sizeId)
    //     //     ->first();
        
    //     $existingProduct = $this->cartProduct->getBy($cart->id, $productId, $sizeId);
    //     if ($existingProduct) {
    //         // If the product already exists, increment the quantity
    //         // $existingProduct->pivot->quantity++;
    //         // $existingProduct->pivot->save();
    //         $quantity = $existingProduct->product_quantity;
    //         $existingProduct->update(['product_quantity' => ($quantity + $request->product_quantity)]);

    //     } else {
    //         // Otherwise, create a new cart product
    //         $cart->products()->attach($product, [
    //             'size_id' => $size->id,
    //             'product_quantity' => 1
    //         ]);
    //     }
        
    //     // return response()->json(['message' => 'Product added to cart.']);
    //     return back()->with(['message' => 'Thêm thành công']);

        

    // }

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

    public function removeProductInCart($id)
    {
         $cartProduct =  $this->cartProduct->find($id);
         $cartProduct->delete();
         $cart =  $cartProduct->cart;
         return response()->json([
             'product_cart_id' => $id,
             'cart' =>new CartResource($cart)
         ], Response::HTTP_OK);
    }


    public function updateQuantityProduct(Request $request, $id)
    {
        $cartProduct =  $this->cartProduct->find($id);
        // dd($cartProduct);
        $dataUpdate = $request->all();

         if($dataUpdate['product_quantity'] < 1 ) {
            $cartProduct->delete();
        } else {
            $cartProduct->update($dataUpdate);
        }

        $cart =  $cartProduct->cart;

        return response()->json([
            'product_cart_id' => $id,
            'cart' => new CartResource($cart),
            'remove_product' => $dataUpdate['product_quantity'] < 1,
            'cart_product_price' => $cartProduct->total_price
            
        ], Response::HTTP_OK);
    }

    // public function showCoupon()
    // {
    //     $coupons = $this->coupon->all();
    //     return view('admin.cart.index', compact('coupons'));
    // }
    public function applyCoupon(Request $request)
    {

        $name = $request->input('coupon_code');

        $coupon =  $this->coupon->firstWithExperyDate($name, auth()->user()->id);

        if($coupon)
        {
            $message = 'Áp Mã giảm giá thành công !';
            Session::put('coupon_id', $coupon->id);
            Session::put('discount_amount_price', $coupon->value);
            Session::put('coupon_code' , $coupon->name);

        }else{

            Session::forget(['coupon_id', 'discount_amount_price', 'coupon_code']);
            $message = 'Mã giảm giá không tồn tại hoặc hết hạn!';
        }

        return redirect()->route('client.carts.index')->with([
            'message' => $message,
        ]);
    }



    public function checkout()
    {
        $cart = $this->cart->firtOrCreateBy(auth()->user()->id)->load('products');
        $user = auth()->user()->id;
        // dd($user);
        return view('client.carts.checkout', compact('cart', 'user'));
    }

    public function processCheckout(CreateOrderRequest $request)
    {

        $dataCreate = $request->all();
        $dataCreate['user_id'] = auth()->user()->id;
        $dataCreate['status'] = 'pending';
        $order = $this->order->create($dataCreate);
        $couponID = Session::get('coupon_id');
        if($couponID)
        {
            $coupon =  $this->coupon->find(Session::get('coupon_id'));
            if($coupon)
            {
                $coupon->users()->attach(auth()->user()->id, ['value' => $coupon->value]);
            }
        }
        $cart = $this->cart->firtOrCreateBy(auth()->user()->id);
        // dd($cart);
        foreach ($cart->products as $product) {
            
            ProductOrder::create([
                'size_id' => $product->size->id,
                'product_id' => $product->product->id,
                'product_quantity' => $product->product_quantity,
                'order_id' => $order->id,
                'user_id' => $order->user->id,
            ]);
        }
        $cart->products()->delete();
        Session::forget(['coupon_id', 'discount_amount_price', 'coupon_code']);
        return redirect()->route('client.carts.index');
    }


}
