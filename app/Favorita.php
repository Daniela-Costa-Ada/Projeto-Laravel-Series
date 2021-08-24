<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Storage;

class Favorita extends Model
{
    public $timestamps = false;
    protected $fillable = ['serie_id', 'usuario_id'];

    public function serie()
    {
        return $this->belongsToMany(Serie::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}