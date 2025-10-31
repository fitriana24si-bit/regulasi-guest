<!DOCTYPE html>
<html lang="en">

{{-- start css --}}
@include('layouts.guest.css')
{{-- end css --}}

<body>
    <!-- Start Header -->
 @include('layouts.guest.header')
    {{-- End heade --}}

    <!-- Content -->
    <main class="container py-5">
        @yield('content')
    </main>

    <!-- start Footer -->
    @include('layouts.guest.footer')
    {{-- end footer --}}


    {{-- star js --}}
    @include('layouts.guest.js')
    {{-- end js --}}
</body>

</html>
