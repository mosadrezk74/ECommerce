@extends('Admin.layout')
@section('page_title', 'Manage Brand')
@section('container')


    @if (session()->has('image.*'))
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
            <span class="badge badge-pill badge-warning">OOps</span>
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <h1 class="mb10">Manage Product Brand</h1>
    <a href="{{ url('admin/brand/') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>

    <div class="row m-t-30">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    {{ session('message') }}
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-exp" class="control-label mb-1">Brand Name</label>
                                            <input name="name" type="text" class="form-control cc-exp" required />
                                            @error('name')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-exp" class="control-label mb-1">Brand Image</label>
                                            <input type="file" name="image"
                                                class="form-control cc-exp" />
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Show in Home Page</label>&nbsp;&nbsp;
                                                <input type="checkbox"  value="1" name="status"  >
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
                    </div>
                </div>
            </div>
        </div>
    @endsection
