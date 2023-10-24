<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Traits\HandleImageTrait;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $size;
    protected $product;
    protected $category;
    protected $productSize;

    public function __construct(Category $category,Product $product, Size $size, ProductSize $productSize )
    {
        $this->category = $category;
        $this->product = $product;
        $this->size = $size;
        $this->productSize = $productSize;

    }

    public function index()
    {
        $products = $this->product->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->get(['id', 'name']);
        $sizes = Size::all();
        return view('admin.products.create', compact('sizes','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(CreateProductRequest $request)
    // {
    //     $dataCreate = $request->except('sizes');
    //     $sizes = $request->sizes ? json_decode($request->sizes) : [];
    //     $product = Product::create($dataCreate);
    //     $dataCreate['image'] = $this->product->saveImage($request);

    //     $product->images()->create(['url' => $dataCreate['image']]);
    //     $product->assignCategory($dataCreate['category_ids']);
    //     $sizeArray = [];
    //     foreach($sizes as $size)
    //     {
    //         $sizeArray[] = ['size' => $size->size, 'price' => $size->price, 'product_id' => $product->id];
    //     }

    //     $product->details()->insert($sizeArray);
    //     return redirect()->route('products.index')->with(['message' => 'Create product success']);
    // }

    public function store(Request $request)
{
   // Validate the request data
    
//     $validatedData = $request->validate([
//         'name' => 'required',
//         'sizes.*.size_id' => 'required|exists:sizes,id',
//         'sizes.*.price' => 'required|numeric',
//     ]);
    
//    // Create the product and attach sizes and prices
    
//     $product = Product::create(['name' => $validatedData['name']]);

//     foreach ($validatedData['sizes'] as $size) {
//         $product->sizes()->attach($size['size_id'], ['price' => $size['price']]);
//     }

//     return response()->json(['message' => 'Product created successfully']);
    // Lưu thông tin sản phẩm
    // $product = new Product;
     $dataCreate = $request->all();
    $product = Product::create($dataCreate);
    $dataCreate['image'] = $this->product->saveImage($request);
    $product->images()->create(['url' => $dataCreate['image']]);
    // $product->name = $request->input('name');
    // $product->description = $request->input('description');
    // $product->sale = $request->input('sale');
    // $product->save();

    //Xử lý và lưu thông tin size và giá
    // foreach ($request->input('size') as $sizeId => $price) {
    //     // Kiểm tra xem size đã tồn tại trong bảng "size" chưa
    //     $size = Size::firstOrNew(['name' => $sizeId['size']]);
    //     if (!$size->exists) {
    //         $size->save(); // Nếu chưa tồn tại, thì lưu mới
    //     }
        
    //     $productSize = new ProductSize;
    //     $productSize->product_id = $product->id;
    //     $productSize->size_id = $size->id;
    //     $productSize->price = $size['price'];
    //     $productSize->save();
        
    // }
    // $product->sizes()->attach($product->assignSize($product['$sizeId']), ['price' =>]);
    $validatedData = $request->validate([
        'sizes' => 'required|array|min:1',
        'sizes.*' => 'exists:sizes,id',
        'prices' => 'required|array|min:1',
        'sizes.*' => 'numeric',
    ]);
    $sizes = $validatedData['sizes'];
    $prices = $validatedData['prices'];
    foreach($sizes as  $index => $sizeId){ 
        $product->sizes()->attach($sizeId, ['price' => $prices[$index]]);
    }
    $product->assignCategory($dataCreate['category_ids']);
  
    return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->product->with(['sizes', 'categories'])->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sizes = Size::all();
        $product = $this->product->with(['sizes', 'categories'])->findOrFail($id);
        return view('admin.products.edit', compact('sizes','product'));
    }
    
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate = $request->except('sizes');
        $product = $this->product->findOrFail($id);
        $currentImage =  $product->images ? $product->images->first()->url : '';
        $dataUpdate['image'] = $this->product->updateImage($request, $currentImage);

        

        $product->images()->create(['url' => $dataUpdate['image']]);
       
        $product->assignCategory($dataUpdate['category_ids']);
        // $product->update([
        //     'name' => $request->input('name'),
        //     'description' => $request->input('description'),
        //     'sale' => $request->input('sale')
        // ]);
        
        foreach ($request->sizes as $sizeId => $sizeData) {
            $price = $sizeData['price'];
            
            $product->sizes()->syncWithoutDetaching([$sizeId => ['price' => $price]]);
        }

        $product->update($dataUpdate);  
        
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete();
        $product->sizes()->delete();
        $product->images()->delete();
        $imageName =  $product->images->count() > 0 ? $product->images->first()->url : '';
        $this->product->deleteImage($imageName);
        return redirect()->route('products.index')->with(['message' => 'Delete product success']);
    }

   
}
