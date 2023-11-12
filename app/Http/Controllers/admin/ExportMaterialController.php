<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ExportMaterial;
use App\Models\Material;
use Illuminate\Http\Request;

class ExportMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $material;
    protected $export;

    public function __construct(Material $material, ExportMaterial $export)
    {
        $this->material = $material;
        $this->export = $export;
    }

    public function index()
    {
        $exports = $this->export->latest('id')->paginate(5);
        return view('admin.exports.index', compact('exports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materials = $this->material->get(['id','name']);
        return view('admin.exports.create', compact('materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $export = new ExportMaterial();
        $export->exporter = $request->input('exporter');
        $export->material_id = $request->input('material');
        $export->export_quantity = $request->input('export_quantity');
        $export->export_date = $request->input('export_date');
        $export->save();
        return redirect()->route('exports.index')->with(['message'=>'Create export success.Please update the quantity of materials in material management !!!']);
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
        $export = $this->export->with(['material'])->findOrFail($id);
        $materials = Material::all();
        return view('admin.exports.edit', compact('export', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $dataUpdate = $request->all();
        $export = $this->export->findOrFail($id);
        $export->exporter = $request->input('exporter');
        $export->material_id = $request->input('material');
        $export->export_quantity = $request->input('export_quantity');
        $export->export_date = $request->input('export_date');
        $export->save();
        return redirect()->route('exports.index')->with(['message'=>'Update export success. Please update the quantity of materials in material management !!!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $export = $this->export->findOrFail($id);
        $export->delete();
        return redirect()->route('exports.index')->with(['message'=>'Delete import material success. Please update the quantity of materials in material management !!!']);
    }
}
