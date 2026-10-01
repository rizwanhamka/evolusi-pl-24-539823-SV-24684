@extends('layouts.app')

@section('title', 'Tambah Catatan')

@section('content')
    <h1>Tambah Catatan</h1>

    <form action="{{ route('catatan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="judul">Judul</label>
            <input
                type="text"
                id="judul"
                name="judul"
                value="{{ old('judul') }}"
                required
            >
            @error('judul')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea
                id="deskripsi"
                name="deskripsi"
            >{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="button">
            Simpan
        </button>

        <a href="{{ route('catatan.index') }}" class="button button-secondary">
            Kembali
        </a>
    </form>
@endsection
