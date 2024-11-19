<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;

class Dosen2Controller extends Controller
{
    public function index()
    {
        return view('dosen.dashboard-2');
    }
}
