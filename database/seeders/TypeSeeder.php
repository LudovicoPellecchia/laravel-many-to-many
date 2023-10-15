<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    private $types = ["Frontend", "Backend", "Fullstack"];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->types as $type) {
            $typeIstance = new Type();

            $typeIstance->name = $type;
            $typeIstance->save();
        //
    }
}

}