@extends('Admin.layout')
@section('page_title', 'Manage Size')
@section('container')

    <h1 class="mb10">Manage Products Size</h1>
    <a href="{{ url('admin/size/') }}">
        <button type="button" class="btn btn-success">Back

        </button>
    </a>

    <div class="row m-t-30">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-body">


                            <form action="{{ route('size.manage_size_process') }}" method="post">

                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group has-success">
                                            <label for="cc-name" class="control-label lg-12">Size</label>
                                            <input name="size" type="size" value="{{ $size }}"
                                                class="form-control cc-name valid" required>
                                            @error('title')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        &nbsp; &nbsp;
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
