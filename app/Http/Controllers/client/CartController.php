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
        return back()->with(['message' => 'Add to cart successfully']);
       } else {
        return back()->with(['message' => 'Please choose size!!!']);
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

    public function payment(){
 
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
    $vnp_TmnCode = " VNWK4HMZ";//Mã website tại VNPAY 
    $vnp_HashSecret = " LSJRHQVKOMJRBOMPCHAAOOVKNEPKPDWU"; //Chuỗi bí mật
    
    $vnp_TxnRef = $_POST['cart_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = $_POST['order_desc'];
    $vnp_OrderType = $_POST['order_type'];
    $vnp_Amount = $_POST['amount'] * 100;
    $vnp_Locale = $_POST['language'];
    $vnp_BankCode = $_POST['bank_code'];
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //Add Params of 2.0.1 Version
    $vnp_ExpireDate = $_POST['txtexpire'];
    //Billing
    $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
    $vnp_Bill_Email = $_POST['txt_billing_email'];
    $fullName = trim($_POST['txt_billing_fullname']);
    if (isset($fullName) && trim($fullName) != '') {
        $name = explode(' ', $fullName);
        $vnp_Bill_FirstName = array_shift($name);
        $vnp_Bill_LastName = array_pop($name);
    }
    $vnp_Bill_Address=$_POST['txt_inv_addr1'];
    $vnp_Bill_City=$_POST['txt_bill_city'];
    $vnp_Bill_Country=$_POST['txt_bill_country'];
    $vnp_Bill_State=$_POST['txt_bill_state'];
    // Invoice
    $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
    $vnp_Inv_Email=$_POST['txt_inv_email'];
    $vnp_Inv_Customer=$_POST['txt_inv_customer'];
    $vnp_Inv_Address=$_POST['txt_inv_addr1'];
    $vnp_Inv_Company=$_POST['txt_inv_company'];
    $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
    $vnp_Inv_Type=$_POST['cbo_inv_type'];
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate"=>$vnp_ExpireDate,
        "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
        "vnp_Bill_Email"=>$vnp_Bill_Email,
        "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
        "vnp_Bill_LastName"=>$vnp_Bill_LastName,
        "vnp_Bill_Address"=>$vnp_Bill_Address,
        "vnp_Bill_City"=>$vnp_Bill_City,
        "vnp_Bill_Country"=>$vnp_Bill_Country,
        "vnp_Inv_Phone"=>$vnp_Inv_Phone,
        "vnp_Inv_Email"=>$vnp_Inv_Email,
        "vnp_Inv_Customer"=>$vnp_Inv_Customer,
        "vnp_Inv_Address"=>$vnp_Inv_Address,
        "vnp_Inv_Company"=>$vnp_Inv_Company,
        "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
        "vnp_Inv_Type"=>$vnp_Inv_Type
    );
    
    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }
    
    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    
    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    
    }
}
