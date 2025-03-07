@extends('Admin/layout')
@section('page_title','Dashboard')
@section('Dashboard_select','active')
@section('container')
 <div class="row">
     <h1>Dashboad</h1>
     {{-- {{$customers}} --}}
  </div>

 
            <div class="row m-t-15">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$customers}}</h2>
                                    <span>Total Customers</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                {{-- <canvas id="widgetChart2"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$acustomers}}</h2>
                                    <span>Active Customers</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                {{-- <canvas id="widgetChart2"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$total}}</h2>
                                    <span>Total Product Sale </span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                {{-- <canvas id="widgetChart2"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$dcustomers}}</h2>
                                    <span>Deactive Customers</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                {{-- <canvas id="widgetChart2"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
         
            <div class="row m-t-15">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$placed}}</h2>
                                    <span>Total Placed Orders</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                {{-- <canvas id="widgetChart2"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$otway}}</h2>
                                    <span>Ontheway product</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                {{-- <canvas id="widgetChart2"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$delevered}}</h2>
                                    <span>Ttl Delevered Products </span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                {{-- <canvas id="widgetChart2"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$successpayment}}</h2>
                                    <span>Total Success Payment</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                {{-- <canvas id="widgetChart2"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection