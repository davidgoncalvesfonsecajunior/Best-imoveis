@extends('Admin.layouts.principal')

@section('conteudo-prncipal')

<section class="section">


    <form action="{{$action}}" method="POST">
        {{-- csrf --}}
        @csrf
         @isset($cidade) {{--verifica se tem dados na variavel --}}
            @method('PUT') {{--se tiver os dados muda o metodo POST para PUT--}}
        @endisset

        <div class="input-field">
            <input type="text" name="nome" id="nome" value="{{old('nome', $cidade->nome ?? '')}}"/>
            <label for="nome">Nome</label>
            @error('nome')
                <span class="red-text text-accent-3"> <small>{{$message}}</small></span>
            @enderror
        </div>

        <div class="right-align">
            <a class="btn-flat waves-effect" href="{{route('admin.cidades.index')}}">Cancelar</a>
            <button class="btn waves-effect waves-light" type="submit">Salvar</button>
        </div>
    </form>
</section>
@endsection
