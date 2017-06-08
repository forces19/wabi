<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SiswaRequest;
use App\Http\Requests;
use App\Siswa;
use App\Telepon;
use App\Kelas;
use Storage;
use Session;
// use Validator;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $siswa_list = Siswa::orderBy('nama_siswa', 'asc')->paginate(5);
        $jumlah_siswa = Siswa::count();
        return view('siswa.index', compact('siswa_list', 'jumlah_siswa'));
    }

    public function create() {
        return view('siswa.create');
    }

    public function store(SiswaRequest $request) {
        $input = $request->all();

        // Upload Foto
        if ($request->hasFile('foto')) {
            $input['foto'] = $this->uploadFoto($request);
        }

        //Simpan data siswa
        $siswa = Siswa::create($input);

        //Simpan data telepon
        if (!empty($input['nomor_telepon'])){
            $telepon = new Telepon;
            $telepon->nomor_telepon = $request->input('nomor_telepon');
            $siswa->telepon()->save($telepon);
        }

        Session::flash('flash_message', 'Data siswa berhasil disimpan');

        return redirect('siswa');
    }

    public function show(Siswa $siswa) {
        return view('siswa.show', compact('halaman', 'siswa'));
    }

    public function edit(Siswa $siswa) {
        if (!empty($siswa->telepon->nomor_telepon)) {
            $siswa->nomor_telepon = $siswa->telepon->nomor_telepon;
        }
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Siswa $siswa, SiswaRequest $request) {
        $input = $request->all();

        // Cek apakah ada foto baru di form?
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            $this->hapusFoto($siswa);

            // Upload foto baru
           $input['foto'] = $this->uploadFoto($request);
        }

        // Update data siswa
        $siswa->update($input);

        // Update telepon
        if (!empty($siswa->telepon->nomor_telepon)) {
            $telepon = $siswa->telepon;
            $telepon->nomor_telepon = $request->input('nomor_telepon');
            $siswa->telepon()->save($telepon);
        }else {
            $telepon = new Telepon;
            $telepon->nomor_telepon = $request->input('nomor_telepon');
            $siswa->telepon()->save($telepon);
        }

        Session::flash('flash_message', 'Data siswa berhasil diupdate');
        return redirect('siswa');
    }

    public function destroy(Siswa $siswa) {
        $this->hapusFoto($siswa);
        $siswa->delete();
        if(!empty($siswa->telepon->nomor_telepon)){
            $siswa->telepon->delete();
        }
        Session::flash('flash_message', 'Data siswa berhasil dihapus');
        Session::flash('penting', true);
        return redirect('siswa');
    }

    public function cari(Request $request)
    {
        $kata_kunci    = trim($request->input('kata_kunci'));

        if (! empty($kata_kunci)) {
            $jenis_kelamin = $request->input('jenis_kelamin');
            $id_kelas      = $request->input('id_kelas');

            // Query
            $query         = Siswa::where('nama_siswa', 'LIKE', '%' . $kata_kunci . '%');
            (! empty($jenis_kelamin)) ? $query->JenisKelamin($jenis_kelamin) : '';
            (! empty($id_kelas)) ? $query->Kelas($id_kelas) : '';
            $siswa_list = $query->paginate(2);

            // URL Links pagination
            $pagination = (! empty($jenis_kelamin)) ? $siswa_list->appends(['jenis_kelamin' => $jenis_kelamin]) : '';
            $pagination = (! empty($id_kelas)) ? $pagination = $siswa_list->appends(['id_kelas' => $id_kelas]) : '';
            $pagination = $siswa_list->appends(['kata_kunci' => $kata_kunci]);

            $jumlah_siswa = $siswa_list->total();
            return view('siswa.index', compact('siswa_list', 'kata_kunci', 'pagination', 'jumlah_siswa', 'id_kelas', 'jenis_kelamin'));
        }

        return redirect('siswa');
    }
    
    // ===============================================================
    private function uploadFoto(SiswaRequest $request)
    {
        $foto = $request->file('foto');
        $ext  = $foto->getClientOriginalExtension();

        if ($request->file('foto')->isValid()) {
            $foto_name   = date('YmdHis'). ".$ext";
            $upload_path = 'fotoupload';
            $request->file('foto')->move($upload_path, $foto_name);

            // Filename untuk database --> 20160220214738.jpg
            return $foto_name;
        }
        return false;
    }

    private function hapusFoto(Siswa $siswa)
    {
        $exist = Storage::disk('foto')->exists($siswa->foto);

        if (isset($siswa->foto) && $exist) {
            $delete = Storage::disk('foto')->delete($siswa->foto);
            if ($delete) {
                return true;
            }
            return false;
        }
    }
}
