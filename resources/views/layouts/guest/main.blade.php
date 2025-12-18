<!DOCTYPE html>
<html lang="en">

{{-- start css --}}
@include('layouts.guest.css')
{{-- end css --}}

<body>
    <!-- Start Header -->
    @include('layouts.guest.header')
    {{-- End header --}}

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="margin: 20px;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="margin: 20px;">
        <strong>Terjadi kesalahan!</strong>
        <ul class="mt-2 mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Content -->
    <main class="w-100 p-0 m-0">
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
