<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   

    <!-- Title Page-->
    <title>@yield('page_title')</title>
    <!-- toggle for on and off -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <!-- Fontfaces CSS-->
    <link href="{{asset('admin_assets/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('admin_assets/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin_assets/css/theme.css')}}" rel="stylesheet" media="all">
   <link  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<style>
    .fa, .fab, .fal, .far, .fas {
  
    color: black;
}
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="{{url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                               
                            </ul>
                        </li>
                     
                        <li class="has-sub">
                            <a class="js-arrow" href="{{url('admin/category')}}">
                                <i class="fas fa-copy"></i>Category</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{url('admin/coupon')}}">
                                <i class="fas fa-tag"></i>Coupon</a>

                            </li>
                            <li class="has-sub">
                            <a class="js-arrow" href="{{url('admin/size')}}">
                                <i class="fas fa-window-maximize"></i>Size</a>

                            </li>
                            <li class="has-sub">
                            <a class="js-arrow" href="{{url('admin/color')}}">
                                <i class="fas fa-paint-brush"></i>Color</a>

                            </li>
                            <li class="@yield('tax_select')">
                            <a href="{{url('admin/tax')}}">
                                <i class="fas fa-percent"></i>Tax</a>
                           
                        </li>
                          
                            <li class="@yield('brand_select')">
                            <a href="{{url('admin/brand')}}">
                                <i class="fas fa-bold"></i>Product Brands</a>
                           
                        </li>

                        <li class="@yield('homebanner_select')">
                            <a href="{{url('admin/homebanner')}}">
                                <i class="fab fa-product-hunt"></i>Home Banner</a>
                           
                        </li>

                            <li class="has-sub">
                            <a class="js-arrow" href="{{url('admin/product')}}">
                                <i class="fab fa-product-hunt"></i>Products</a>

                            </li>

                            <li class="has-sub">
                            <a class="js-arrow" href="{{url('admin/customer')}}">
                                <i class="fas fa-user"></i>Customers</a>

                            </li>
                            
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="button.html">Button</a>
                                </li>
                                <li>
                                    <a href="badge.html">Badges</a>
                                </li>
                                <li>
                                    <a href="tab.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                               
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">

                    <h2>Your Shopping</h2>
                    {{-- <img src="{{asset('admin_assets/images/icon/logo.png')}}" alt="Cool Admin" /> --}}
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('Dashboard_select')">
                            <a class="js-arrow" href="{{url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                           
                        </li>

                        <li class="@yield('Order_select')">
                            <a  href="{{url('admin/order')}}">
                                <i class="fas fa-shopping-basket"></i>Order</a>

                            </li>        
                       
                        <li class="@yield('Category_select')">
                            <a  href="{{url('admin/category')}}">
                                <i class="fas fa-list"></i>Category</a>
                                


                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="@yield('Coupon_select')">
                            <a href="{{url('admin/coupon')}}">
                                <i class="fas fa-tag"></i>Coupon</a>
                           
                        </li>
                        <li class="@yield('Size_select')">
                            <a href="{{url('admin/size')}}">
                                <i class="fas fa-window-maximize"></i>Size</a>
                           
                        </li>

                        <li class="@yield('Color_select')">
                            <a href="{{url('admin/color')}}">
                                <i class="fas fa-paint-brush"></i>Color</a>
                           
                        </li>

                        <li class="@yield('Tax_select')">
                            <a href="{{url('admin/tax')}}">
                                <i class="fas fa-percent"></i>Tax</a>
                           
                        </li>

                        <li class="@yield('brand_select')">
                            <a href="{{url('admin/brand')}}">
                                <i class="fa fa-bold"></i>Brands</a>
                           
                        </li>
                        <li class="@yield('homebanner_select')">
                            <a href="{{url('admin/homebanner')}}">
                                <i class="fa fa-bold"></i>Home Banner</a>
                           
                        </li>
                        <li class="@yield('Product_select')">
                            <a href="{{url('admin/product')}}">
                                <i class="fab fa-product-hunt"></i>Products</a>
                           
                        </li>

                        <li class="@yield('Customer_select')">
                            <a href="{{url('admin/customer')}}">
                                <i class="fa fa-user"></i>Customers</a>
                           
                        </li>

                        <li class="@yield('Report_select')">
                            <a href="{{url('admin/report')}}">
                                <i class="fa fa-user"></i>Report</a>
                           
                        </li>
                    </ul>
                 
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                              
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                       
                                        <div class="mess-dropdown js-dropdown">
                                           
                                            <div class="mess__item">
                                               
                                                <div class="content">
                                                   
                                                </div>
                                            </div>
                                            <div class="mess__item">
                                                <div>
                                                  
                                                </div>
                                                <div class="content">
                                                   
                                                </div>
                                            </div>
                                            <div class="mess__footer">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                       
                                        <div class="email-dropdown js-dropdown">
                                           
                                            <div class="email__footer">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                              
                                            </div>
                                            <div class="notifi__item">
                                               
                                                <div class="content">
                                                   
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                               
                                                <div class="content">
                                                    
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                               
                                                <div class="content">
                                                   
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                       
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                           
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{url('admin/logout')}}">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    @section('container')
                                           @show
                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTAINER-->

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Jquery JS-->
    <!-- <script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script> -->
    <!-- Bootstrap JS-->
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('admin_assets/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('admin_assets/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('admin_assets/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('admin_assets/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('admin_assets/js/main.js')}}"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <!-- @if(Session::has('Category Added Successfull'))
    <script>
        toastr.success("{!!session::get('Category Added Successfull')!!}");
    </script>
    @endif -->
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
</body>

</html>
<!-- end document-->
