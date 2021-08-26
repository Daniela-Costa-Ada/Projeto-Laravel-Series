<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Storage;
use Illuminate\Support\Facades\Auth;


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

    //método que busca as séries que são favoritas para realizar verificacao na página inicial
    public static function getFavoritas()
    {
        $usuario_id = Auth::user()->id;
        return Favorita::where('usuario_id', '=', $usuario_id)
            ->join('series', 'series.id', '=', 'favoritas.serie_id')->get();
    }

    //método que busca séries para a página de séries favoritas do usuário
    public static function getPaginaListaSeriesFavoritas()
    {
        $usuario_id = Auth::user()->id;
        return Favorita::where('usuario_id', '=', $usuario_id)
            ->join('series', 'series.id', '=', 'favoritas.serie_id')->get();
    }


    public static function postFavorita(int $id)
    {
        $serie_id = $id;
        $usuario_id = Auth::user()->id;

        return Favorita::create([
            'serie_id' => $serie_id,
            'usuario_id' => $usuario_id
        ]);
    }

    public static function postDesfavorita(int $id)
    {
       $usuario_id = Auth::user()->id;
       return Favorita::where('serie_id', '=' ,$id)
        ->where('usuario_id', '=', $usuario_id)
        ->delete();
    }

}