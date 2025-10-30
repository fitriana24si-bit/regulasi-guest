<!DOCTYPE html>
<html lang="en">

{{-- start css --}}
@include('layouts.css')
{{-- end css --}}

<body>
    <!-- Start Header -->
 @include('layouts.header')
    {{-- End heade --}}

    <!-- Content -->
    <main class="container py-5">
        @yield('content')
    </main>

    <!-- start Footer -->
    @include('layouts.footer')
    {{-- end footer --}}


    {{-- star js --}}
    @include('layouts.js')
    {{-- end js --}}
</body>

</html>
