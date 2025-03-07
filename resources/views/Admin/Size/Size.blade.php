@extends('Admin.layout')
@section('page_title', 'Size')
@section('Size_select', 'active')
@section('container')
    <style>
        .btn-danger {
            color: #fff;
            background-color: white;
            border-color: none;
            border: none;
        }

    </style>
    @if (session()->has('message'))
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
            <span class="badge badge-pill badge-warning">Success</span>
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif


    <h1 class="mb10">Size</h1>
    <a href="size/manage_size">
        <button type="button" class="btn btn-success">Add Product Size

        </button>
    </a>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->


            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Products Size</th>

                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$data)
                            <tr>

                                <td>{{ $key+1}}</td>

                                <td>{{ $data->size }}</td>
                                <td>
                                    @if ($data->status == 1)
                                        <a href="{{ url('admin/size/status/0') }}/{{ $data->id }}">
                                            <button type="button" class="btn btn-success">Active</button>
                                        </a>
                                    @elseif($data->status == 0)
                                        <a href="{{ url('admin/size/status/1') }}/{{ $data->id }}">
                                            <button type="button" class="btn btn-danger">Deactive</button>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/size/manage_size/') }}/{{ $data->id }}"> <i
                                            class="fas fa-edit"></i> </a>



                                    <form method="get" action="{{ url('admin/size/delete') }}/{{ $data->id }}"">
                                                            @csrf
                                                       
                                                            {{-- <input name="_method" type="hidden" value="DELETE"> --}}
                                                          
                                                          <a class=" btn btn-xs btn-danger btn-flat show_confirm">
                                        {{-- <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button> --}}
                                        <i class="fas fa-trash"></i>
                                        </a>


                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>

@endsection
