@extends("layouts.app")

@section("content")

<div class="container">
    <form action="{{route('admin.projects.update', $project->slug )}}" method="POST" class="mt-5" enctype="multipart/form-data">
        @csrf()
        @method("PATCH")

        <div class="mb-3">
            <label class="form-label mb-1">Titolo </label>
            <input type="text" class="form-control" name="titolo" value="{{$project->titolo}}">
        </div>

        <div class="mb-3">
            <label class="form-label mb-1">Immagine </label>
            <input type="file" class="form-control" name="immagine">
        </div>

        <div class="mb-3">
            <label class="form-label mb-1">Descrizione </label>
            <textarea type="text" class="form-control" name="descrizione" placeholder="Inserisci una descrizione">{{$project->descrizione}}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label mb-1">Seleziona un Tipo </label>
            <select type="text" class="form-control" name="type_id">

                @foreach ($types as $type)
                <option value="{{ $type->id }}">{{$type->name}}</option>
                @endforeach
            </select>
        </div>

        <label class="form-label mb-1">Seleziona un Linguaggio </label>
        <div class="mb-3">
            @foreach ($technologies as $technology)
            <div class="form-check form-check-inline" >
                <input class="form-check-input" type="checkbox" name="technologies[]" id="{{$technology->id}}" value="{{$technology->id}}" {{ $project->technologies?->contains($technology) ? 'checked' : '' }}>
                <label class="form-check-label" for="{{$technology->id}}">{{$technology->nome}}</label>
            </div>
            @endforeach
        </div>
        <div class="mb-3">
            <label class="form-label mb-1">Link_github </label>
            <input type="text" class="form-control" name="link_github" value="{{$project->link_github}}">
        </div>


        <button class="btn btn-primary mt-4">Modifica Progetto</button>
    </form>

    <a href="{{route('admin.projects.show', $project->slug)}}"><button class="btn btn-primary mt-4">Torna Indietro</button></a>

</div>


@endsection