<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;
    protected $table = 'administrasis';
    protected $fillable = [
        'semester',
        'nilai_ipk',
        'dosen_wali',
        'transkrip_nilai',
        'status',
        'user_id',
        'program_mbkm',
        'mata_kuliah_1',
        'mata_kuliah_2',
        'mata_kuliah_3',
        'mata_kuliah_4',
        'mata_kuliah_5',
        'status2',
        'status3',
        'nama_wali_dosen',
        'note1',
        'note2',
        'note3',
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
