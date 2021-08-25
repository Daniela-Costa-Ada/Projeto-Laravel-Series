<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriaSeeder extends Seeder
{
    static $nomes = [
        'terror',
        'suspense',
        'ficcao cientifica',
        'fantasia',
        'virtual reality'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$nomes as $nome) {
            DB::table('categoria')->insert([
                'nome' => $nome
            ]);
        }
        /**Categoria::create([
            'nome' => 'terror'
        ]);**/
    }
}
