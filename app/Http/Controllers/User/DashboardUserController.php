<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class DashboardUserController extends Controller
{
    public function index()
    {
        $totalPinjam = Peminjaman::where('user_id', auth()->id())->count();
        $menunggu    = Peminjaman::where('user_id', auth()->id())->where('status','menunggu')->count();
        $disetujui   = Peminjaman::where('user_id', auth()->id())->where('status','disetujui')->count();

        return view('user.dashboard', compact('totalPinjam','menunggu','disetujui'));
    }
}