<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catatan;

class CatatanApiController extends Controller
{
    public function index()
    {
        return response()->json(Catatan::latest()->get());
    }
}
