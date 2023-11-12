<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $supplier;
    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function index()
    {
        $suppliers = $this->supplier->latest('id')->paginate(5);
        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataCreate = $request->all();
        $this->supplier->create($dataCreate);
        return redirect()->route('suppliers.index')->with(['message' => 'create supplier success']);
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
        $supplier = $this->supplier->findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = $this->supplier->findOrFail($id);
        $dataUpdate = $request->all();
        $supplier->update($dataUpdate);
        return redirect()->route('suppliers.index')->with(['message' => 'Update supplier success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = $this->supplier->findOrFail($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with(['message' => 'Delete '.$supplier->name.' success']);
    }
}
