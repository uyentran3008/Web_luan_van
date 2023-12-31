<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Materials\UpdateMaterialRequest;
use App\Models\ImportMaterial;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $material;
    protected $import;
    public function __construct(Material $material,ImportMaterial $import)
    {
        $this->material = $material;
        $this->import = $import;
    }
    public function index()
    {
        $materials = $this->material->latest('id')->paginate(5);
        // $imports = ImportMaterial::where('material_id', $materials)->latest()->first();
        return view('admin.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $material = new Material();
        $material->name = $request->input('name');
        $material->unit_of_measure = $request->input('unit_of_measure');
        $material->price = $request->input('price');
        $material->inventory_number = $request->input('inventory_number');
        $material->save();
        return redirect()->route('materials.index')->with(['message' => 'create material success']);
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
        $material = $this->material->findOrFail($id);
        // $import = ImportMaterial::where('material_id', $id)->latest()->first();
        // $import = $material->latestImport()->quantity_entered;
        return view('admin.materials.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $material = $this->material->findOrFail($id);
        $dataUpdate = $request->all();
        $material->update($dataUpdate);
        return redirect()->route('materials.index')->with(['message'=>'Update material success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = $this->material->findOrFail($id);
        $material->delete();
        return redirect()->route('materials.index')->with(['message'=>'Delete Material Success']);
    }
}
