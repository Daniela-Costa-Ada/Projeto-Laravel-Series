<?php
namespace App;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Storage;
class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome', 'capa'];
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
    }// uma serie, por enquanto, pertence a uma categoria
}