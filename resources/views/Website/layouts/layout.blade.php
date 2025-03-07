<html>

@include('Website.layouts.head')
@livewireStyles
<body>
    @include('Website.layouts.header')

    @yield('content')

    @include('Website.layouts.footer')

    @include('Website.layouts.scripts')
    @livewireScripts

</body>

</html>
