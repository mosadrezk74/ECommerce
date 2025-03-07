@extends('Admin.layout')
@section('page_title', 'Manage Coupon')
@section('container')

    <h1 class="mb10">Manage Coupon</h1>
    <a href="{{ url('admin/coupon/') }}">
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


                            <form action="{{ route('coupon.store') }}" method="post">

                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group has-success">
                                            <label for="cc-name" class="control-label lg-12">Title</label>
                                            <input name="title" type="text"
                                                class="form-control cc-name valid" required>
                                            @error('title')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label lg-12">Code</label>
                                                <input name="code" type="text"
                                                    class="form-control cc-name valid" required>
                                                @error('code')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group has-success">
                                                    <label for="cc-name" class="control-label lg-12">Value</label>
                                                    <input name="value" type="text"
                                                        class="form-control cc-name valid" required>

                                                    @error('value')
                                                        <div class="alert alert-danger">
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group has-success">
                                                        <label for="cc-name" class="control-label lg-12"> Value Type</label>

                                                        <select id="type" name="type" class="form-control" required>
                                                                <option value="Value" selected>Value</option>
                                                                <option value="Per">Percentage</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group has-success">
                                                        <label for="cc-name" class="control-label lg-12">Minimum Order
                                                            Amount</label>
                                                        <input name="min_order_amt" type="text"
                                                            class="form-control cc-name valid" required>

                                                    </div>
                                                </div>


                                                <div class="col-4">
                                                    <div class="form-group has-success">
                                                        <label for="cc-name" class="control-label lg-12">Is One Time</label>

                                                        <select id="is_one_time" name="is_one_time" class="form-control"
                                                            required>

                                                                <option value="1" selected>Yes</option>
                                                                <option value="0">No</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                &nbsp; &nbsp;
                                                <div>
                                                    <button id="payment-button" type="submit"
                                                        class="btn btn-lg btn-info btn-block">
                                                        submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
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
