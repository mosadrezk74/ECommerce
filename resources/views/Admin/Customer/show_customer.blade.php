@extends('Admin.layout')
@section('page_title', 'Customer Details')
@section('Customer_select', 'active')
@section('container')





    <h1 class="mb10">Customer Details</h1>

    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="table-responsive m-b-40">

                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">{{ $customer_list->name }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Address</th>
                            <th scope="col">{{ $customer_list->address }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">{{ $customer_list->mobile }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">State</th>
                            <th scope="col">{{ $customer_list->state }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Zip</th>
                            <th scope="col">{{ $customer_list->zip }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Country</th>
                            <th scope="col">{{ $customer_list->country }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Gender</th>
                            <th scope="col">{{ $customer_list->gender }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Email Id</th>
                            <th scope="col">{{ $customer_list->email }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Password</th>
                            <th scope="col">{{ $customer_list->password }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Company</th>
                            <th scope="col">{{ $customer_list->company }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Created at</th>
                            <th scope="col">
                                {{                                 \Carbon\Carbon::parse($customer_list->created_at)->format('Y-m-d h:i:s:A') }}
                            </th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Updated at</th>
                            <th scope="col">
                                {{                                 \Carbon\Carbon::parse($customer_list->updated_at)->format('Y-m-d h:i:s:A') }}
                            </th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

@endsection
