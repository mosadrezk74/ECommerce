@extends('Admin.layout')
@section('page_title', 'Product')
@section('Product_select', 'active')
@section('container')

    <!-- display msg -->

    @if (session()->has('message'))
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
            <span class="badge badge-pill badge-warning">Success</span>
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif


    <h1 class="mb10">Product</h1>
    <a href="{{ url('admin/product/create') }}">
        <button type="button" class="btn btn-success">
            Add Product
        </button>
    </a>

    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->

            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Product Price</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                        <img width="50px" height="50px" alt="image"
                                             src="{{ asset('uploads/students/' . $product->photo) }}"
                                        />
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    @if ($product->status == 1)

                                        <button
                                            type="button" class="btn btn-success">
                                            Active
                                        </button>
                                    @elseif($product->status == 0)

                                            <button
                                                type="button" class="btn btn-danger">
                                                Inactive
                                            </button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/product/manage_product/') }}/{{ $product->id }}"> <i
                                            class="fas fa-edit"></i> </a>

                                    &nbsp; &nbsp;
                                    <a href="{{ url('admin/product/delete') }}/{{ $product->id }}"> <i
                                            class="fas fa-trash"></i> </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection
