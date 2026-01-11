<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\Usuario;

use Faker\Factory;

$faker = Factory::create('es_ES');

for($i=0; $i<100; $i++) {

    Usuario::create([

        'nombre' => $faker->name,

        'fechanacimiento' => $faker->date('Y-m-d', '2005-01-01'),

        'telefono' => $faker->numerify('##########'),

        'fechaingreso' => $faker->date('Y-m-d', '2023-01-01')

    ]);

}

echo "100 usuarios creados\n";