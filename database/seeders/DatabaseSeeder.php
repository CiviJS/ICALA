<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Faker\Factory;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;



    public function run(): void
    {
        $faker = Factory::create('es_ES');
        for($i=0; $i<100; $i++) {

            Usuario::create([

                'nombre' => $faker->name,

                'fechanacimiento' => $faker->date('Y-m-d', '2005-01-01'),
        
                'telefono' => $faker->numerify('##########'),
        
                'fechaingreso' => $faker->date('Y-m-d', '2023-01-01')

            ]);

        }
    }
}
