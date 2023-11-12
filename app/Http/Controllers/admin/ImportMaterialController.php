<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ImportMaterial;
use App\Models\Material;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class ImportMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $supplier;
    protected $material;
    protected $user;
    protected $import;
    public function __construct(Supplier $supplier, Material $material, User $user, ImportMaterial $import)
    {
        $this->supplier = $supplier;
        $this->material = $material;
        $this->user = $user;
        $this->import = $import;
    }
    public function index()
    {
        // $imports = $this->import->latest('id')->paginate(5);
        $imports = ImportMaterial::with(['supplier', 'material'])->latest('id')->paginate(5);
        return view('admin.imports.index', compact('imports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = $this->supplier->get(['id','name']);
        $materials = $this->material->get(['id','name']);
        
        return view('admin.imports.create', compact('suppliers','materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $dataCreate = $request->all();
        // $import = ImportMaterial::create($dataCreate);
        // // $import->assignSupplier($dataCreate['supplier_ids']);
        // // $import->assignMaterial($dataCreate['material_ids']);
        $import = new ImportMaterial();
        $import->importer = $request->input('importer');
        $import->supplier_id = $request->input('supplier');
        $import->material_id = $request->input('material');
        $import->quantity_entered = $request->input('quantity_entered');
        $import->import_date = $request->input('import_date');
        $import->save();
        
        
        return redirect()->route('imports.index')->with(['message'=>'Create import material success. Please update the quantity of materials in material management !!!']);
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
        $import = $this->import->with(['supplier', 'material'])->findOrFail($id);
        $suppliers = Supplier::all();
        $materials = Material::all();
        return view('admin.imports.edit', compact('import','suppliers', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $import = $this->import->findOrFail($id);
        $import->importer = $request->input('importer');
        $import->supplier_id = $request->input('supplier');
        $import->material_id = $request->input('material');
        $import->quantity_entered = $request->input('quantity_entered');
        $import->import_date = $request->input('import_date');
        $import->save();
        return redirect()->route('imports.index')->with(['message'=>'Update import material success. Please update the quantity of materials in material management !!!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $import = $this->import->findOrFail($id);
        $import->delete();
        return redirect()->route('imports.index')->with(['message'=>'Delete import material success']);
    }
}
