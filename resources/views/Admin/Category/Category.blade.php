@extends('Admin.layout')
@section('page_title', 'Category')
@section('Category_select', 'active')
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


    <h1 class="mb10">Category</h1>
    <a href="{{url('admin/category/create')}}">
        <button type="button" class="btn btn-success">
            Add Category
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
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $cat)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cat->category_name}}</td>
                                <td>{{ $cat->category_desc}}</td>
                                <td>
                                    @if ($cat->status == 1)

                                            <button type="button" class="btn btn-success">Active</button>

                                    @elseif($cat->status == 0)

                                            <button type="button" class="btn btn-danger">inactive</button>

                                    @endif

                                </td>
                                <td>
                                    <a href="{{ url('admin/category/manage_category/') }}/{{ $cat->id }}"> <i
                                            class="fas fa-edit"></i> </a>

                                    &nbsp; &nbsp;
                                    <a href="{{ url('admin/category/delete') }}/{{ $cat->id }}"> <i
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
