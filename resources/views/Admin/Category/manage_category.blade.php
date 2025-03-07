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
                            <form action="{{ route('category.manage_category_process') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-exp" class="control-label mb-1">Category Name</label>
                                            <input name="category_name" value="{{ $category_name }}"
                                                class="form-control cc-exp" required>
                                            @error('category_name')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Category Slug</label>
                                                <input name="category_slug" value="{{ $category_slug }}"
                                                    class="form-control cc-exp" required>
                                                @error('category_slug')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Category Image</label>
                                                <input name="category_image" type="file" class="form-control cc-exp">
                                                @if ($category_image != '')
                                                    <a href="{{ asset('storage/media/category/category' . $category_image) }}"
                                                        target="_blank"><img width="60px"
                                                            src="{{ asset('storage/media/category/' . $category_image) }}" /></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Parent Category</label>
                                                <select id="parent_category_id" name="parent_category_id"
                                                    class="form-control" required>
                                                    <option value="0">Select Categories</option>
                                                    @foreach ($category as $list)
                                                        @if ($id == $list->id)
                                                            <option selected value="{{ $list->id }}">
                                                            @else
                                                            <option value="{{ $list->id }}">
                                                        @endif
                                                        {{ $list->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Show in Home
                                                    Page</label>&nbsp;&nbsp;
                                                <input type="checkbox" id="is_home" name="is_home" {{ $is_home_selected }}>

                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            submit
                                        </button>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $id }}" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
