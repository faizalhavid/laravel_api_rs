<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesialis extends Model
{
    use HasFactory;
    protected $guarded  =['id'];
    public $timestamps = false;

    public function dokter(){
        return $this->hasmany(Dokter::class);
    }
}
