<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sop extends Model
{
    use HasFactory;
    protected $table = 'sops';
    protected $fillable = ['nama', 'klasifikasi_dokumen', 'nomor_dokumen', 'file', 'persetujuan_mr','persetujuan_sekretaris', 'status_pengesahan_direktur'];
    
}

