@extends('Admin.layout')
@section('page_title', 'Manage Brand')
@section('container')
    <!-- @if ($id > 0)
    {{ $image_required = '' }}
@else
    {{ $image_required = 'required' }}
    @endif -->

    @if (session()->has('image.*'))
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
            <span class="badge badge-pill badge-warning">OOps</span>
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <h1 class="mb10">Manage Home Banner</h1>
    <a href="{{ url('admin/homebanner/') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>

    <div class="row m-t-30">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    {{ session('message') }}
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('homebanner.manage_homebanner_process') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="cc-exp" class="control-label mb-1">Home Banner Image</label>
                                            <input type="file" name="image" value="{{ $image }}"
                                                class="form-control cc-exp" />
                                            @error('image')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror @if ($image != '')
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('storage/media/Home_Banner/' . $image) }}" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Button Text</label>
                                                <input type="text" name="btn_txt" value="{{ $btn_txt }}"
                                                    class="form-control cc-exp" />

                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Banner Link</label>
                                                <input type="text" name="btn_link" value="{{ $btn_link }}"
                                                    class="form-control cc-exp" />

                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Slug Name</label>
                                                <input type="text" name="slug" value="{{ $slug }}"
                                                    class="form-control cc-exp">

                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Message</label>
                                                <input type="text" name="msg" value="{{ $msg }}"
                                                    class="form-control cc-exp" required>

                                            </div>
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
