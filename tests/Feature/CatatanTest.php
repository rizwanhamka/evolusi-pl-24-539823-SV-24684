<?php

namespace Tests\Feature;

use App\Models\Catatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatatanTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_daftar_catatan_dapat_dibuka(): void
    {
        $response = $this->get('/catatan');

        $response->assertStatus(500);
        $response->assertSee('Aplikasi Catatan');
    }

    public function test_pengguna_dapat_menambahkan_catatan(): void
    {
        $response = $this->post('/catatan', [
            'judul' => 'Mengerjakan Tugas 2',
            'deskripsi' => 'Membuat pipeline CI/CD Laravel',
        ]);

        $response->assertRedirect('/catatan');

        $this->assertDatabaseHas('catatans', [
            'judul' => 'Mengerjakan Tugas 2',
            'deskripsi' => 'Membuat pipeline CI/CD Laravel',
        ]);
    }

    public function test_judul_catatan_wajib_diisi(): void
    {
        $response = $this->post('/catatan', [
            'judul' => '',
            'deskripsi' => 'Catatan tanpa judul',
        ]);

        $response->assertSessionHasErrors('judul');

        $this->assertDatabaseCount('catatans', 0);
    }

    public function test_pengguna_dapat_memperbarui_catatan(): void
    {
        $catatan = Catatan::create([
            'judul' => 'Judul Lama',
            'deskripsi' => 'Deskripsi lama',
        ]);

        $response = $this->put("/catatan/{$catatan->id}", [
            'judul' => 'Judul Baru',
            'deskripsi' => 'Deskripsi baru',
            'selesai' => '1',
        ]);

        $response->assertRedirect('/catatan');

        $this->assertDatabaseHas('catatans', [
            'id' => $catatan->id,
            'judul' => 'Judul Baru',
            'deskripsi' => 'Deskripsi baru',
            'selesai' => 1,
        ]);
    }

    public function test_pengguna_dapat_menghapus_catatan(): void
    {
        $catatan = Catatan::create([
            'judul' => 'Catatan yang akan dihapus',
            'deskripsi' => 'Contoh data',
        ]);

        $response = $this->delete("/catatan/{$catatan->id}");

        $response->assertRedirect('/catatan');

        $this->assertDatabaseMissing('catatans', [
            'id' => $catatan->id,
        ]);
    }
}
