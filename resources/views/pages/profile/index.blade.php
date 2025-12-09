@extends('layouts.guest.main')

@section('content')

<div class="container mt-4">

    <h2 class="mb-3">Data User</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>
                    @if ($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" width="50" class="rounded">
                    @else
                        <img src="{{ asset('default-avatar.png') }}" width="50" class="rounded">
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    {{ $users->links() }}

</div>

@endsection
