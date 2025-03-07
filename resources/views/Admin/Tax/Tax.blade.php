@extends('Admin.layout')
@section('page_title', 'Tax')
@section('Tax_select', 'active')
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
    <h1 class="mb10">Tax</h1>
    <a href="tax/manage_tax">
        <button type="button" class="btn btn-success">Add Product Tax
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
                            <th>Tax Description</th>
                            <th>Tax Value</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->tax_desc }}</td>
                                <td>{{ $data->tax_value }}</td>
                                <td>
                                    @if ($data->status == 1)
                                        <a href="{{ url('admin/tax/status/0') }}/{{ $data->id }}">
                                            <button type="button" class="btn btn-success">Active</button>
                                        </a>
                                    @elseif($data->status == 0)
                                        <a href="{{ url('admin/tax/status/1') }}/{{ $data->id }}">
                                            <button type="button" class="btn btn-danger">Deactive</button>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/tax/manage_tax/') }}/{{ $data->id }}"> <i
                                            class="fas fa-edit"></i> </a>
                                    &nbsp; &nbsp;
                                    <a href="{{ url('admin/tax/delete') }}/{{ $data->id }}"> <i
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
