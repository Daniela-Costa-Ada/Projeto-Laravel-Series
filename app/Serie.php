<?php
namespace App;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Storage;

class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome', 'capa', 'categoria_id'];

    public function getCapaUrlAttribute()
    {
        if ($this->capa) {
            return FacadesStorage::url($this->capa) ;
        }
        return FacadesStorage::url('serie/sem-imagem.jpg');      
        
    }    
    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function favorita()
    {
        return $this->belongsToMany(Favorita::class);
    }
    public static function getSeries()
    {
        return  Serie::join('categorias', 'series.categoria_id', '=', 'categorias.id')
        ->select('series.*', 'categorias.nome as categoriaNome') 
        ->get();
    } 

   
}