@extends('Admin.layout')
@section('page_title', 'Manage Category')
@section('container')
    <h1 class="mb10">Manage Category</h1>
    <a href="{{ url('admin/category/') }}">
        <button type="button" class="btn btn-success">Back
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    {{ session('message') }}
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('category.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-exp" class="control-label mb-1">Category Name</label>
                                            <input name="category_name"
                                                class="form-control cc-exp" required>
                                            @error('category_name')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Category Description</label>
                                                <input name="category_desc"
                                                    class="form-control cc-exp" required>
                                                @error('category_desc')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
