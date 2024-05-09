<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruModel extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $primarykey = 'id_guru';
    public $timestamps = false;
    public $fillable = ['nama_guru', 'mapel'];
}
