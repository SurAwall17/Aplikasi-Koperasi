<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Pengesahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function getNotification(){
        $pengajuanUser = Pengajuan::where('userId', Auth::user()->id)->pluck('id');
        $pengesahan = Pengesahan::whereIn('pengajuanId', $pengajuanUser)->get();

        // $jumlahNotifikasi = Pengesahan::whereIn('pengajuanId', $pengajuanUser)->count();
        return view('/notifikasi', [
            "pengesahan" => $pengesahan,
            "title" => "Notifikasi",
        ]);
    }
}
