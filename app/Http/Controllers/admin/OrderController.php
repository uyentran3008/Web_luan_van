<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
// use Barryvdh\DomPDF\PDF as DomPDFPDF;
// use PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $order;
  
    public function __construct(Order $order )
    {
        $this->order = $order;

    }

    public function index()
    {
        // $orders =  $this->order->getWithPaginateBy(auth()->user()->id);
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        // $orders = $this->order->get();
        // $order = $this->order->get('id');
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request ,$id)
    {
        $order =  $this->order->findOrFail($id);
        $order->update(['status' => $request->status]);
        return  response()->json([
            'message' => 'success'
        ], HttpResponse::HTTP_OK);
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
    public function show($orderId)
    {
        $orderUserId = Order::where('id', $orderId)->value('user_id');
        $orderDetails = DB::table('carts')
        ->join('orders', 'carts.user_id', '=', 'orders.user_id')
        ->where('carts.user_id', $orderUserId)
        ->where('orders.id', $orderId)
        ->select('orders.*', 'carts.id as cart_id')
        ->first();
        dd($orderDetails);

        return view('admin.orders.show', compact('order'));
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
