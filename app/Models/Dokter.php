<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded =['id'];

    public function spesialis (){
        return $this->belongsTo(Spesialis::class,'fk_spesialis','id');
    }

    public function poli(){
        return $this->belongsTo(Poliklinik::class,'fk_poli','id');
    }

}
