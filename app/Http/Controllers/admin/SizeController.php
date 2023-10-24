<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sizes\CreateSizeRequest;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected  $size;
    protected $product;
    //protected $product_size;

    public function __construct(Size $size, Product $product)
    {
        $this->size = $size;
        $this->product = $product;
    }
    public function index()
    {
        // $sizes = Size::all();
        // return response()->json(['sizes' => $sizes]);
        $sizes = $this->size->latest()->paginate(3);
        return view('admin.sizes.index', compact('sizes'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sizes = $this->size->all();
        return view('admin.sizes.create',compact('sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataCreate = $request->all();

        $size = $this->size->create($dataCreate);

        return  redirect()->route('sizes.index')->with(['message' => 'create new size product success ']);
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
        $sizes = $this->size->all();
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
        $size = $this->size->findOrFail($id);

        $size->delete();
        return redirect()->route('sizes.index')->with(['message'=>'Delete category '.$size->name." sucesss"]);
    }
}
