@extends('layouts.app')

@section('title', 'Edit Catatan')

@section('content')
    <h1>Edit Catatan</h1>

    <form
        action="{{ route('catatan.update', $catatan) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="judul">Judul</label>
            <input
                type="text"
                id="judul"
                name="judul"
                value="{{ old('judul', $catatan->judul) }}"
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
            >{{ old('deskripsi', $catatan->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>
                <input
                    type="checkbox"
                    name="selesai"
                    value="1"
                    @checked(old('selesai', $catatan->selesai))
                >
                Tandai sebagai selesai
            </label>
        </div>

        <button type="submit" class="button">
            Simpan Perubahan
        </button>

        <a href="{{ route('catatan.index') }}" class="button button-secondary">
            Kembali
        </a>
    </form>
@endsection
