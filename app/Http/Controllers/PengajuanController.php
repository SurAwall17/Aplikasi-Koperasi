<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\KategoriKoperasi;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function viewPengajuan(){
        $index = 0;
        $data = Pengajuan::where('userId', Auth::user()->id)->get();
        $kategori = KategoriKoperasi::all();

        return view('/pengajuan', [
            "title" => "Pengajuan",
            "index" => $index,
            "data" => $data,
            "kategori_koperasi" => $kategori
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategoriId' => 'required',
            'tgl_pengajuan' => 'required|date',
            'no_npak' => 'required|string|max:50',
            'nama_koperasi' => 'required|string|max:255',
            'alamat_koperasi' => 'required|string',
            'simpanan_pokok' => 'required|numeric',
            'simpanan_wajib' => 'required|numeric',
            'jumlah_pengurus' => 'required|numeric',
            'nama_ketua' => 'required|string|max:255',
            'nama_wakil' => 'required|string|max:255',
            'nama_sekretaris' => 'required|string|max:255',
            'nama_bendahara' => 'required|string|max:255',
            'pengawas' => 'required|string|max:255',
            'rencana_kegiatan' => 'required|string',
            'data_npak' => 'nullable|file|mimes:docx,pdf,jpg,png|max:2048'
        ]);

        if ($request->hasFile('data_npak')) {
            $file = $request->file('data_npak');
            $fileName = 'npak/'.time().'_'.$file->getClientOriginalName();
            
            $path = $file->storeAs('public', $fileName);
        } else {
            $fileName = null;
        }

        Pengajuan::create([
            'userId' => Auth::user()->id,
            'kategoriId' => $request->kategoriId,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'no_npak' => $request->no_npak,
            'nama_koperasi' => $request->nama_koperasi,
            'alamat_koperasi' => $request->alamat_koperasi,
            'simpanan_pokok' => $request->simpanan_pokok,
            'simpanan_wajib' => $request->simpanan_wajib,
            'jumlah_pengurus' => $request->jumlah_pengurus,
            'nama_ketua' => $request->nama_ketua,
            'nama_wakil' => $request->nama_wakil,
            'nama_sekretaris' => $request->nama_sekretaris,
            'nama_bendahara' => $request->nama_bendahara,
            'pengawas' => $request->pengawas,
            'rencana_kegiatan' => $request->rencana_kegiatan,
            'data_npak' => $fileName,
        ]);

        return redirect('/pengajuan')->with('success', 'Data pengajuan berhasil ditambahkan!');
    }

    public function UpdatePengajuan($id, Request $request){
        $data = Pengajuan::find($id);

        $request->validate([
            'kategoriId' => 'required',
            'tgl_pengajuan' => 'required|date',
            'no_npak' => 'required|string|max:50',
            'nama_koperasi' => 'required|string|max:255',
            'alamat_koperasi' => 'required|string',
            'simpanan_pokok' => 'required|numeric',
            'simpanan_wajib' => 'required|numeric',
            'jumlah_pengurus' => 'required|numeric',
            'nama_ketua' => 'required|string|max:255',
            'nama_wakil' => 'required|string|max:255',
            'nama_sekretaris' => 'required|string|max:255',
            'nama_bendahara' => 'required|string|max:255',
            'pengawas' => 'required|string|max:255',
            'rencana_kegiatan' => 'required|string',
            'data_npak' => 'nullable|file|mimes:docx,pdf,jpg,png|max:2048'
        ]);

        if ($request->hasFile('data_npak')) {
            $file = $request->file('data_npak');
            $fileName = 'npak/'.time().'_'.$file->getClientOriginalName();
            
            $path = $file->storeAs('public', $fileName);
        }else{
            $fileName = $data->data_npak;
        }

        $data->update([
            // 'userId' => Auth::user()->id,
            'kategoriId' => $request->kategoriId,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'no_npak' => $request->no_npak,
            'nama_koperasi' => $request->nama_koperasi,
            'alamat_koperasi' => $request->alamat_koperasi,
            'simpanan_pokok' => $request->simpanan_pokok,
            'simpanan_wajib' => $request->simpanan_wajib,
            'jumlah_pengurus' => $request->jumlah_pengurus,
            'nama_ketua' => $request->nama_ketua,
            'nama_wakil' => $request->nama_wakil,
            'nama_sekretaris' => $request->nama_sekretaris,
            'nama_bendahara' => $request->nama_bendahara,
            'pengawas' => $request->pengawas,
            'rencana_kegiatan' => $request->rencana_kegiatan,
            'data_npak' => $fileName,
        ]);
        return redirect('pengajuan')->with('success', 'Data pengajuan berhasil di ubah!');

    }
}
