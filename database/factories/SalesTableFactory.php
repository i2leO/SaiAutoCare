<?php

use Faker\Generator as Faker;

$factory->define(App\Sale::class, function (Faker $faker) {
    return [
        'submited_part_discription' => $faker->paragraph,
        'notes' => $faker->paragraph(ran(2,10))

        }
    ];
});
