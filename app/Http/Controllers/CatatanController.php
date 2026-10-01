<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatatanController extends Controller
{
    public function index(): View
    {
        $catatans = Catatan::latest()->get();

        return view('catatan.index', compact('catatans'));
    }

    public function create(): View
    {
        return view('catatan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        Catatan::create($validated);

        return redirect()
            ->route('catatan.index')
            ->with('success', 'Catatan berhasil ditambahkan.');
    }

    public function edit(Catatan $catatan): View
    {
        return view('catatan.edit', compact('catatan'));
    }

    public function update(
        Request $request,
        Catatan $catatan
    ): RedirectResponse {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'selesai' => ['sometimes', 'boolean'],
        ]);

        $validated['selesai'] = $request->boolean('selesai');

        $catatan->update($validated);

        return redirect()
            ->route('catatan.index')
            ->with('success', 'Catatan berhasil diperbarui.');
    }

    public function destroy(Catatan $catatan): RedirectResponse
    {
        $catatan->delete();

        return redirect()
            ->route('catatan.index')
            ->with('success', 'Catatan berhasil dihapus.');
    }
}
