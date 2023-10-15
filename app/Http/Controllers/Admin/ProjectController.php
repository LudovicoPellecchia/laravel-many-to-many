<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::all();
        //ritorno la lista dei progetti
        return view("admin.projects.index", compact('projects'));
    }





    public function show($slug){
        //recupero il primo progetto nel db che ha quello specifico slug 
        $show_project = Project::where("slug", $slug)->first();

        return view("admin.projects.show", compact("show_project"));
    }





    public function create(){
        $types = Type::all();
        $technologies = Technology::all();

        return view("admin.projects.create", compact("types", "technologies"));
    }




    public function store(StoreProjectRequest $request){
        //recupero i dati inseriti nel form create e validati dal FormRequest
        $data = $request->validated();
        //genero uno slug unico per la nuova istanza
        $data["slug"] = $this->generateSlug($data["titolo"]);
        //prende file img dal frontend, lo rinomina e lo salva in una cartella nello storage
        $data["immagine"] = Storage::put("projects", $data["immagine"]);
        //eseguo fill dei campi dell'istanza (è necessaria la variabile fillable nel Model con tutti i campi), e la salvo nel db
        $newProject = Project::create($data);
        //dopo aver salvato la nuova istanza del model Project utilizzo il metodo technologies con cui accedo alla tabella
        // ponte tra projects e techonologies e assegno i dati "technologies" alla nuova istanza "newProject" 
        
        if($request->technologies){
            $newProject->technologies()->attach($data["technologies"]);
        }

        return redirect()->route("admin.projects.show", $newProject->slug);
    }




    public function edit($slug){
        $types = Type::all();
        $technologies = Technology::all();

        $project = Project::where("slug", $slug)->firstOrFail();
        //ritorno la view con il form per modificare i dati del singolo progetto
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }




    public function update(UpdateProjectRequest $request, $slug){
        //recupero i dati aggiornati dall'edit e validati dal FormRequest
        $data = $request->validated();
        //recupero il progetto non modificato dal database
        $project = Project::where("slug", $slug)->firstOrFail();
        //se il titolo è stato modificato genero un altro slug
        if ($data["titolo"] !== $project->titolo) {
            $data["slug"] = $this->generateSlug($data["titolo"]);
        }
        //se la request al FormRequest ha un file immagine, prende file img dal frontend, lo rinomina e lo salva in una cartella nello storage
        if ($request->hasFile('immagine')) {
            $data["immagine"] = Storage::put("projects", $data["immagine"]);
                    //elimino la precedente immagine dal db
                    Storage::delete($project->immagine);
        }

        //se data['technologies] è diverso da na
        if (isset($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        }else{
            $project->technologies()->detach();
        }        


        //aggiorno e salvo i nuovi dati nel database
        $project->update($data);
        return redirect()->route("admin.projects.show", $project->slug);
    }

    


    protected function destroy($slug){
        //recupero dal db il progetto con quel determinato slug
        $project = Project::where("slug", $slug)->firstOrFail();
        //elimino la immagine dal db se presente
        if ($project->immagine) {
            Storage::delete($project->immagine);
        }
        //elimino i collegamenti con la tabella ponte
        $project->technologies()->detach();
        //lo elimino
        $project->delete();
        //redirect all'index con la lista dei progetti
        return redirect()->route("admin.projects.index");
    }



    protected function generateSlug($title) {
        $counter = 0;

        do {
            $slug = Str::slug($title) . ($counter > 0 ? "-" . $counter : "");

            $alreadyExists = Project::where("slug", $slug)->first();

            $counter++;
        } while ($alreadyExists);
        return $slug;
    }




}
