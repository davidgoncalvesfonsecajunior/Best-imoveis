<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\CidadeRequest;

use App\Models\cidade;
use App\Models\Cidade as ModelsCidade;

class CidadeController extends Controller
{
    public function cidades()
    {
        $subtitulo = 'Lista de Cidades';

        // $cidades = ['Belo Horizonte', 'Recife', 'Florianópolis'];

        $cidades = Cidade::all();

        return view('admin.cidades.index', compact('subtitulo', 'cidades'));
    }

    public function formAdicionar()
    {
        $action = route('admin.cidades.adicionar');
        return view('Admin.cidades.form', compact('action'));
    }

    public function adicionar(CidadeRequest $request)
    {

        // criar um objeto do modelo da classe
        cidade::create($request->all());

        $request->session()->flash('sucesso', "cidade $request->nome inserida com sucesso!");

        return redirect()->route('admin.cidades.listar');
    }

    public function deletar($id, Request $request)
    {
        cidade::destroy($id);
        $request->session()->flash('sucesso', "Cidade excluida com sucesso!");

        return redirect()->route('admin.cidades.listar');
    }

    public function formEditar($id)
    {
        $cidade = cidade::find($id);
        $action = route('admin.cidades.editar', $cidade->id);

        return view('Admin.cidades.form', compact('cidade', 'action'));
    }

    public function editar(CidadeRequest $request, $id)
    {
        $cidade = cidade::find($id);
        $cidade->update($request->all());
        $request->session()->flash('sucesso', "Cidade $request->nome alterada com sucesso!");

        return redirect()->route('admin.cidades.listar');
    }
}
