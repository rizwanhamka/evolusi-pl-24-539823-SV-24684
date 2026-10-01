<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'selesai',
    ];

    protected function casts(): array
    {
        return [
            'selesai' => 'boolean',
        ];
    }
}
