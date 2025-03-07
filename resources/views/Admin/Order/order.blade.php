@extends('Admin.layout')
@section('page_title','Order')
@section('Orde_select','active')
@section('container')

<!-- display msg -->
<h1 class="mb10">Order</h1>
     <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                            
                              

                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Order Date</th>
                                                <th>Customer Details</th>
                                                <th>Amount</th>
                                                <th>Order Status</th>
                                                <th>Payment Status</th>
                                              
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                       @foreach($orders as $key=>$list)
                                       <tr>
                                           <td><a href="{{url('admin/order_detail')}}/{{{$list->id}}}">{{$key+1}}</a></td>
                                           <td>{{$list->added_on}}</td>
                                           <td>{{$list->name}}<br>
                                            {{$list->email}}<br>
                                            {{$list->address}}<br>
                                            {{$list->mobile}}<br>
                                           
                                        
                                        </td>
                                           <td>{{$list->total_amt}}</td>
                                           <td>
                                               @if($list->order_status==1)
                                         
                                            <button type="button" class="btn btn-warning">Placed</button>

                                          @elseif($list->order_status==2)
                                              <button type="button" class="btn btn-warning">On the Way</button>
                                          @else
                                              <button type="button" class="btn btn-success">Delivered</button>
                                          @endif
                                            
                                            </td>
                                           <td>
                                            @if($list->payment_status=="Success")
                                         
                                            <button type="button" class="btn btn-success">Success</button>

                                          @elseif($list->payment_status=="Pending")
                                              <button type="button" class="btn btn-warning">Pending</button>
                                          @else
                                              <button type="button" class="btn btn-danger">Failed</button>
                                          @endif
                                        
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