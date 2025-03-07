@extends('Admin.layout')
@section('page_title', 'Manage Tax')
@section('container')
    <h1 class="mb10">Manage Products Tax</h1>
    <a href="{{ url('admin/tax/') }}">
        <button type="button" class="btn btn-success">Back
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('tax.manage_tax_process') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group has-success">
                                            <label for="cc-name" class="control-label lg-12">Tax Description</label>
                                            <input name="tax_desc" type="text" value="{{ $tax_desc }}"
                                                class="form-control cc-name valid" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group has-success">
                                            <label for="cc-name" class="control-label lg-12">Tax Value</label>
                                            <input name="tax_value" type="text" value="{{ $tax_value }}"
                                                class="form-control cc-name valid" required>
                                            @error('tax_value')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
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
