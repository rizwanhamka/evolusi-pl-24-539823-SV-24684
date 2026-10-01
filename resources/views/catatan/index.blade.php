@extends('layouts.app')

@section('title', 'Daftar Catatan')

@section('content')
    <h1>Aplikasi Catatan</h1>
    <p>Kelola daftar catatan dan aktivitas Anda.</p>

    <a href="{{ route('catatan.create') }}" class="button">
        + Tambah Catatan
    </a>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($catatans as $catatan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $catatan->judul }}</td>
                    <td>{{ $catatan->deskripsi ?? '-' }}</td>
                    <td>
                        <span class="status">
                            {{ $catatan->selesai ? 'Selesai' : 'Belum selesai' }}
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <a
                                href="{{ route('catatan.edit', $catatan) }}"
                                class="button button-secondary"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('catatan.destroy', $catatan) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus catatan ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button class="button button-danger" type="submit">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada catatan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
