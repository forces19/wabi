<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $dates = ['tanggal_lahir'];
    protected $fillable = [
        'nisn',
        'nama_siswa',
        'tanggal_lahir',
        'jenis_kelamin',
        'id_kelas',
        'foto',
    ];

    public function getNamaSiswaAttribute($nama_siswa) {
        return ucwords($nama_siswa);
    }

    public function telepon() {
        return $this->hasOne('App\Telepon', 'id_siswa');
    }

    public function kelas() {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }

    public function scopeKelas($query, $id_kelas)
    {
        return $query->where('id_kelas', $id_kelas);
    }

    public function scopeJenisKelamin($query, $jenis_kelamin)
    {
        return $query->where('jenis_kelamin', $jenis_kelamin);
    }
}
