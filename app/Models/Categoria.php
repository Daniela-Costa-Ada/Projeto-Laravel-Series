<?php
namespace App\Models;
use App\Serie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Categoria extends Model
{
    //use HasFactory;
    protected $fillable = ['nome'];
    public function serie()
    {
        return $this->hasMany(Serie::class);
    }//uma categoria tem muitas séries
}
