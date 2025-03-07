@extends('Admin.layout')
@section('page_title', 'Color')
@section('Color_select', 'active')
@section('container')


    @if (session()->has('message'))
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
            <span class="badge badge-pill badge-warning">Success</span>
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif


    <h1 class="mb10">Color</h1>
    <a href="{{route('color.create')}}">
        <button type="button" class="btn btn-success">Add Color

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
                            <th>Color Name</th>

                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $color)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $color->color }}</td>


                                <td>
                                    <a href="{{ url('admin/color/manage_color/') }}/{{ $color->id }}"> <i
                                            class="fas fa-edit"></i> </a>

                                    &nbsp; &nbsp;
                                    <a href="{{ url('admin/color/delete') }}/{{ $color->id }}"> <i
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
