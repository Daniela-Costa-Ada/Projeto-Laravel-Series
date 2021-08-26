<?php
namespace App\Http\Controllers;
use App\Events\NovaSerie;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Categoria;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request) {
 
        $mensagem = $request->session()->get('mensagem');
        $series = Serie::getSeries();
        return view('series.index', compact('series', 'mensagem'));
    }//faz uma query no banco buscando os dados da Serie e exibindo na view

    public function create()
    {
        $categorias = Categoria::query()       
        ->get();
        return view('series.create', compact('categorias'));
    }//Adiciona uma serie ao dar input nos dados atraves da view

    public function store(
        SeriesFormRequest $request,
        CriadorDeSerie $criadorDeSerie
    ) {
        $capa = null;
        if ($request->hasFile('capa')) 
        {
            $capa = $request->file('capa')->store('serie');
            //dd($request->file('capa')->store('serie'));
        }       
        
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada,
            $capa,
            $request->categoria_id
        );
      $eventoNovaSerie = new NovaSerie(
          $request->nome, 
          $request->qtd_temporadas, 
          $request->ep_por_temporada
      );//cria uma evento 
      event($eventoNovaSerie);//emite o evento para envio de email   
    $request->session()
        ->flash(
            'mensagem',
            "Série {$serie->nome} e suas temporadas e episódios criados com sucesso"
        );

    return redirect()->route('listar_series');
    }//depois que chma o servico para criar a serie redireciona para aviwe index de listar serie

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Série $nomeSerie removida com sucesso"
            );
        return redirect()->route('listar_series');
    }
    public function editaNome(int $id, Request $request)
    {
        $serie = Serie::find($id);
        $novoNome = $request->nome;
        $serie->nome = $novoNome;
        $serie->save();
    }
    
}

