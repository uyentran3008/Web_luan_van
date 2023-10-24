@extends('admin.layouts.app')
@section('title', 'Edit Product')


@section('content')
    <div class="card">
        <h1>Edit Product</h1>

        <div>
            <form action="{{ route('products.update', $product->id) }}" method="post" id="createForm" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class=" input-group-static col-5 mb-4">
                        <label>Image</label>
                        <input type="file" accept="image/*" name="image" id="image-input" class="form-control">

                        @error('image')
                            <span class="text-danger"></span>
                        @enderror
                    </div>
                    <div class="col-5">
                        <img src="{{ $product->images ? asset('upload/' . $product->images->first()->url) : 'upload/default.png' }}" id="show-image" alt="" width="300px">
                    </div>
                </div>

                <div class="input-group input-group-static mb-4">
                    <label>Name</label>
                    <input type="text" value="{{ old('name') ?? $product->name }}" name="name" class="form-control">

                    @error('name')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                {{-- <div class="form-group">
                    <label >Sizes and Prices</label>
                    <div id="sizes-container"> --}}
                        {{-- @foreach($product->sizes as $size)
                        <div class="size-row">
                          <input type="text" name="size[]" value="{{ old($size->id) ?? $size->name }}" placeholder="Size">
                          <input type="number" name="price[]" value="{{ old($size->pivot->price) ?? $size->pivot->price }}" placeholder="Price">
                        </div>
                        @endforeach --}}
                        
                        {{-- @foreach($product->sizes as $size) --}}
                            {{-- <div class="size-row">
                                <div class="form-group">
                                    <label for="size_name">Size Name:</label>
                                    <input type="hidden" name="sizes[id][]" value="{{ $size->id }}">
                                    <input type="text" id="size_name" name="sizes[name][]" value="{{ old($size->id) ?? $size->name }}" >
                                </div>
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="number"  id="price" name="sizes[price][]" value="{{  old($size->pivot->price) ?? $size->pivot->price }}" >
                                </div>
                            </div> 
                            
                      
                        
                        @foreach ($sizes as $size)
                            <div>

                                <label style="margin-right: 10px" for="sizes[{{ $size->id }}][price]">{{ $size->name }}</label>
                                <input type="number" name="sizes[{{ $size->id }}][price]" value="{{ $product->sizes->find($size->id)->pivot->price ?? '' }}">
                                
                            </div>
                        @endforeach


                    </div>
                    
                </div>--}}
            
                {{-- <div class="form-group">
                    <label for="sizes">Sizes and Prices</label>
                    <table class="table" id="tableSize">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                             @foreach($sizes as $size)
                            <tr>
                                <td>
                                    {{-- <input type="checkbox" name="sizes[]" value="{{ $size->id }}" id="size_{{ $size->id }}"> 
                                    <label style="margin-right: 10px" for="sizes[{{ $size->id }}][price]">{{ $size->name }}</label>
                                </td>
                                <td>
                                    <input type="number" name="sizes[{{ $size->id }}][price]" value="{{ $product->sizes->find($size->id)->pivot->price ?? '' }}">
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}

                {{-- <div id="sizes-container">
                    @foreach ($product->sizes as $size)
                        <div class="size-row">
                            <input type="number" name="sizes[{{ $size->id }}][price]" value="{{ $size->pivot->price }}">
                            <label>{{ $size->name }}</label>
                            <button type="button" class="remove-size">Remove</button>
                        </div>
                    @endforeach
                </div> --}}
                <div class="form-group">
                    <label>Size and Price</label>
                    <div id="sizes-container">
                        @foreach ($product->sizes as $size)
                            <div class="size-row">
                                
                                <label>Size: {{ $size->name }}</label>
                                <input type="number" name="sizes[{{ $size->id }}][price]" value="{{ $size->pivot->price }}">
                                <button type="button" class="remove-size">Remove</button>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <label for="size-dropdown">Select Size:</label>
                        <select id="size-dropdown">
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select> 
                        <button type="button" id="add-size">Add Size</button>
                    </div>
                   
                </div>

                <div class="input-group input-group-static mb-4">
                    <label>Sale</label>
                    <input type="text" value="0" value="{{ old('sale') ?? $product->sale }}" name="sale" class="form-control">
                    @error('sale')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>



                <div class="form-group">
                    <label>Description</label>
                    <div class="row w-100 h-100">
                        <textarea name="description" id="description" class="form-control" cols="4" rows="5"
                            style="width: 100%">{{ old('description') ?? $product->description}} </textarea>
                    </div>
                    @error('description')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                
        
                <div class="input-group input-group-static mb-4">
                    <label name="group" class="ms-0">Category</label>
                    <select name="category_ids[]" class="form-control" multiple>
                        @foreach ($product->categories as $item)
                            <option value="{{ $item->id }}"{{ $product->categories->contains('id', $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>

                    @error('category_ids')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-submit btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
