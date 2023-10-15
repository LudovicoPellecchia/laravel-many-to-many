@extends("layouts.app")

@section("content")

<h1 class="text-center mt-4">{{$show_project->titolo}}</h1>
<div class="container">
    <div class="card">
        <img src={{asset('/storage/' . $show_project->immagine)}} class="card-img-top" >
        <div class="card-body">
            <h5 class="card-title">{{$show_project->titolo}}</h5>
            <p class="card-text">{{$show_project->descrizione}}</p>
            <p class="card-text">{{$show_project->type->name}}</p>
            <div >
                @foreach ($show_project->technologies as $technology )
                <p class="card-text" style="background-color: hsl(240, 79%, 84%); padding:5px; border-radius:5px">{{$technology?->nome}}</p>
                @endforeach
            </div>
            <div class="text-end fs-4"><a href="{{route('admin.projects.edit', $show_project->slug)}}">Modifica</a></div>

            <form action="{{route('admin.projects.destroy', $show_project->slug)}}" method="POST">
                @csrf()
                @method("DELETE")
                <button class="btn btn-danger">Elimina</button>
            </form>
        </div>
    </div>

    <div>
        <a href="{{route('admin.projects.index')}}"><button class="btn btn-primary mt-5">Torna Indietro</button></a>
    </div>
</div>

@endsection