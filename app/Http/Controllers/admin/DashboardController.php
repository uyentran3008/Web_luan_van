<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ExportMaterial;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $user;
    protected $product;
    protected $category;
    protected $order;

    public function __construct(User $user, Product $product, Category $category, Order $order)
    {
        $this->user = $user;
        $this->product = $product;
        $this->category = $category;
        $this->order = $order;
    }

    public function index(Request $request)
    {
        $countProduct  = $this->product->count();
        $countCategory  = $this->category->count();
        $countUser  = $this->user->count();
        $countOrder  = $this->order->count();

        $selectedMonth = $request->input('selected_month', now()->month);
        $totalInputCost = DB::table('import_materials')
        ->join('materials', 'import_materials.material_id', '=', 'materials.id')
        ->whereMonth('import_materials.import_date', $selectedMonth)
        ->sum(DB::raw('import_materials.quantity_entered * materials.price'));
        $totalExportCost = DB::table('export_materials')
        ->join('materials', 'export_materials.material_id', '=', 'materials.id')
        ->whereMonth('export_materials.export_date', $selectedMonth)
        ->sum(DB::raw('export_materials.export_quantity * materials.price'));
        $monthlyRevenue = DB::table('orders')
        ->whereMonth('created_at', $selectedMonth)
        ->sum('total');
        

        $startDate = $request->input('start_date', now()->subMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));
        $statisticData = Order::selectRaw('DATE(created_at) as date, COUNT(*) as order_count, SUM(total) as total_revenue')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $totalRevenue = DB::table('orders')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total');
        $totalOrder = DB::table('orders')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        
        return view('admin.dashboard.index', compact('countProduct','countUser','countCategory','countOrder','startDate', 'endDate','statisticData','selectedMonth','totalInputCost','totalExportCost','totalRevenue','totalOrder','monthlyRevenue'));
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
}
