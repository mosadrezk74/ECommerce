@extends('Admin.layout')
@section('page_title', 'Coupon')
@section('Coupon_select', 'active')
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


    <h1 class="mb10">Coupon</h1>
    <a href="coupon/create">
        <button type="button" class="btn btn-success">Add Coupon

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
                            <th>Titile</th>
                            <th>Code</th>
                            <th>Value</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $coupon->title }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->value }}</td>
                                <td>
                                    @if ($coupon->status == 1)
                                        <a href="{{ url('admin/coupon/status/0') }}/{{ $coupon->id }}">
                                            <button type="button" class="btn btn-success">Active</button>
                                        </a>
                                    @elseif($coupon->status == 0)
                                        <a href="{{ url('admin/coupon/status/1') }}/{{ $coupon->id }}">
                                            <button type="button" class="btn btn-danger">Deactive</button>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/coupon/manage_coupon/') }}/{{ $coupon->id }}"> <i
                                            class="fas fa-edit"></i> </a>

                                    &nbsp; &nbsp;
                                    <a href="{{ url('admin/coupon/delete') }}/{{ $coupon->id }}"> <i
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
