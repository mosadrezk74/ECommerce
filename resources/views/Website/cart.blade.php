@extends('Website.layouts.layout')

@section('title')
    Cart
@endsection

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{url('/')}}" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(session('cart'))
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                @foreach(session('cart') as $id => $details)
                                    <tr>
                                            <td class="image product-thumbnail">
                                                <img  style="width: 100% ; height:100% "
                                                      src="{{ asset('uploads/students/' . $details['photo']) }}"
                                                      alt="image placeholder">
                                            </td>
                                            <td class="product-des product-name">
                                                <h5 class="product-name">
                                                    <a href="">
                                                        {{ $details['name'] }}
                                                    </a>
                                                </h5>
                                                <p class="font-xs">

                                                    {{$details['short_desc']}}
                                                 </p>
                                            </td>
                                            <td class="price" data-title="Price">
                                                <span>${{ $details['price'] }} </span>
                                            </td>
                                            <td class="text-center" data-title="quantity">
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}">
                                            </td>
                                            <td class="text-right" data-title="Cart">
                                                <span>${{ $details['price'] * $details['quantity'] }}</span>
                                            </td>
                                            <td class="action" data-title="Remove"><a href="{{route('remove_from_cart', $id)}}" class="text-muted"><i
                                                        class="fi-rs-trash"></i></a></td>

                                        @php
                                            $totalPrice += $details['price'] * $details['quantity'];
                                        @endphp
                                        </tr>

                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <a href="{{route('remove_from_cart', $id)}}" class="text-muted"> <i class="fi-rs-cross-small"></i>
                                                Clear
                                                Cart
                                            </a>
                                        </td>
                                        @endforeach
                                        @endif

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    <td class="cart_total_amount"><span
                                                            class="font-lg fw-900 text-brand">$
                                                        {{ $totalPrice }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Shipping</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i>
                                                        Free
                                                        Shipping
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span
                                                                class="font-xl fw-900 text-brand">${{$totalPrice}}</span></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="DotCom" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Proceed
                                        To CheckOut</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
