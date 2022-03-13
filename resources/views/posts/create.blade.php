@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Creaar Articulo') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form
                        action="{{ route('posts.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        <div class="form-group mb-3">
                            <label >Titulo *</label>
                            <input type="text" name="title" class="form-control" required placeholder="Introduzca el titulo">
                        </div>
                        <div class="form-group mb-3">
                            <label>Imagen</label>
                            <input type="file" name="file" >
                        </div>
                        <div class="form-group mb-3">
                            <label >Contenido *</label>
                            <textarea name="body" rows="6" class="form-control" required placeholder="Introduzca el contenido..."></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label >Contenido embebido</label>
                            <textarea name="iframe" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            @csrf
                            <input type="submit" value="Enviar" class="btn btn-sm btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
