<!DOCTYPE html>
<html>

<head>

    {{-- @include ('partials.header_auth') --}}
    @include ('partials.header')

</head>

<body class="gray-bg">

    @yield ('content')

    <!-- Mainly scripts -->
    {{-- @include ('partials.footer_auth_js') --}}
    @include ('partials.footer_js')

</body>

</html>
