@extends('Admin.layout')
@section('page_title', 'Manage Product')
@section('Product_select', 'active')
@section('container')
    <h1 class="mb10">Manage Product</h1>
    <a href="{{ url('admin/product/') }}">
        <button type="button" class="btn btn-success">Back
        </button>
    </a>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <div class="row m-t-30">
        <div class="col-md-12">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="name" class="control-label mb-1">Product Name</label>
                                            <input id="name"  name="name" type="text"
                                                class="form-control" aria-required="true" aria-invalid="false" >
                                            @error('name')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="image" class="control-label mb-1">Product Photo</label>
                                            <input class="form-control" type="file" name="photo">
                                            @error('image')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="image" class="control-label mb-1">Price</label>
                                            <input id="name"  name="price" type="text"
                                                   class="form-control" aria-required="true" aria-invalid="false" >
                                            @error('Price')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="category_id" class="control-label mb-1">Product Category</label>
                                            <select id="category_id" name="category_id" class="form-control" required>
                                                <option value="">Select Categories</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}">
                                                        {{ $cat->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="brand" class="control-label mb-1"> Brand</label>
                                            <select id="brand" name="brand_id" class="form-control" required>
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">
                                                        {{ $brand->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="model" class="control-label mb-1"> Model</label>
                                            <input id="model"  name="model" type="text"
                                                class="form-control" aria-required="true" aria-invalid="false" required>
                                        </div>
                                        @error('Model')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="category_id" class="control-label mb-1"><b>
                                                    Short  Description</b>
                                            </label>
                                            <input id="model"  name="short_desc" type="text"
                                                   class="form-control" aria-required="true"
                                                   aria-invalid="false" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="brand" class="control-label mb-1"><b>Description</b></label>
                                            <input id="model"  name="desc" type="text"
                                                   class="form-control" aria-required="true"
                                                   aria-invalid="false" required>
                                        </div>



                                        <div class="col-md-6">
                                            <label for="category_id" class="control-label mb-1"><b>
                                                    Technical  Specification</b>
                                            </label>
                                            <input id="model"  name="technical_specification" type="text"
                                                   class="form-control" aria-required="true"
                                                   aria-invalid="false" required>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="model" class="control-label mb-1"> Keywords</label>
                                            <input id="model"  name="keywords" type="text"
                                                   class="form-control" aria-required="true"
                                                   aria-invalid="false" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="model" class="control-label mb-1">Warranty</label>
                                            <input id="model"  name="warranty" type="text"
                                                   class="form-control" aria-required="true"
                                                   aria-invalid="false" >
                                        </div>

                                        <div class="col-md-4">
                                            <label for="model" class="control-label mb-1">Stock</label>
                                            <input id="model"  name="stock" type="text"
                                                   class="form-control" aria-required="true"
                                                   aria-invalid="false" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="model" class="control-label mb-1">Tax Rate</label>
                                            <select id="tax_id" name="tax_id" class="form-control" required>
                                                <option value="">Select Tax</option>
                                                @foreach ($taxes as $tax)
                                                    <option value="{{ $tax->id }}">
                                                        {{ $tax->tax_value }} %
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="model" class="control-label mb-1">Is Promo</label>
                                            <select  id="is_promo" name="is_promo" class="form-control" required>
                                                <option value="0" selected>No</option>
                                                <option value="1" >Yes</option>
                                            </select>

                                        </div>

                                        <div class="col-md-4">
                                            <label for="status" class="control-label mb-1">Status</label>
                                            <select  id="status" name="status" class="form-control" required>
                                                <option value="0" selected>No</option>
                                                <option value="1" >Yes</option>
                                            </select>

                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="model" class="control-label mb-1">Is Featured</label>
                                            <select id="is_featured" name="is_featured" class="form-control" required>
                                                <option value="0" selected >No</option>
                                                    <option value="1" >Yes</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="model" class="control-label mb-1">Is Trending</label>
                                            <select id="is_tranding" name="is_tranding" class="form-control" required>
                                                <option value="0" selected>No</option>
                                                <option value="1" >Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
