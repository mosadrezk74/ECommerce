@extends('Admin.layout')
@section('page_title', 'Customer')
@section('Customer_select', 'active')
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

    <h1 class="mb10">Customer</h1>

    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->

            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>

                            <th>Address</th>
                            <th>Phone</th>

                            <th>Email Id</th>

                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->address }}</td>
                                <td>{{ $data->mobile }}</td>
                                <td>{{ $data->email }}</td>

                                <td>
                                    @if ($data->status == 1)
                                        <a href="{{ url('admin/customer/status/0') }}/{{ $data->id }}">
                                            <button type="button" class="btn btn-success">Active</button>
                                        </a>
                                    @elseif($data->status == 0)
                                        <a href="{{ url('admin/customer/status/1') }}/{{ $data->id }}">
                                            <button type="button" class="btn btn-danger">Deactive</button>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/customer/show/') }}/{{ $data->id }}"> <i
                                            class="fas fa-eye"></i> </a>

                                    &nbsp; &nbsp;
                                    <a href="{{ url('admin/color/delete') }}/{{ $data->id }}"> <i
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
