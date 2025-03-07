@extends('Admin.layout')
@section('page_title', 'Brand')
@section('brand_select', 'active')
@section('container')



<h1 class="mb10">Brand</h1>
<a href="{{route('brand.create')}}">
    <button type="button" class="btn btn-success">Add Product Brand</button>
</a>

<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->

        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand Name</th>

                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $brand->name }}</td>

                            <td>
                                <img src="{{ asset('uploads/players/' . $brand->image) }}" width="50px" height="50px"
                                    alt="">
                            </td>
                            <td>
                                @if ($brand->status == 1)
                                    <a href="{{ url('admin/brand/status/0') }}/{{ $brand->id }}">
                                        <button type="button" class="btn btn-success">Active</button>
                                    </a>
                                @elseif($brand->status == 0)
                                    <a href="{{ url('admin/brand/status/1') }}/{{ $brand->id }}">
                                        <button type="button" class="btn btn-danger">Deactive</button>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('admin/brand/manage_brand/') }}/{{ $brand->id }}"> <i
                                        class="fas fa-edit"></i> </a>

                                &nbsp; &nbsp;
                                <a href="{{ url('admin/brand/delete') }}/{{ $brand->id }}"> <i
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
