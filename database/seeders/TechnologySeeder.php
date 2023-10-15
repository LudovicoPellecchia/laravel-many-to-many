<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    protected $technologies = [
        [
            "nome" => "Javascript",
            "descrizione" => "Un linguaggio di programmazione ampiamente utilizzato per la creazione di pagine web dinamiche e interattive",
        ],
        [
            "nome" => "Vue.js",
            "descrizione" => "Un framework JavaScript progressivo per la creazione di interfacce utente (UI) moderne e reattive."
        ],
        [
            "nome" => "PHP",
            "descrizione" => "Un linguaggio di scripting lato server ampiamente utilizzato per sviluppare applicazioni web dinamiche."
        ],
        [
            "nome" => "Laravel",
            "descrizione" => "Un framework PHP che semplifica lo sviluppo di applicazioni web grazie a una sintassi chiara e a numerose funzionalità integrate"
        ],
        [
            "nome" => "CSS",
            "descrizione" => "Un linguaggio di stile utilizzato per definire la presentazione e il layout delle pagine web"
        ],
        [
            "nome" => "SCSS",
            "descrizione" => "Una versione migliorata di CSS che consente di scrivere stili più efficienti e organizzati utilizzando funzionalità come variabili, mixin e altro."
        ],

    ];
    


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->technologies as $technology) {
            $newTechnology = new Technology();

            $newTechnology->nome = $technology["nome"];
            $newTechnology->descrizione = $technology["descrizione"];
            $newTechnology->save();
        }
    }
}
