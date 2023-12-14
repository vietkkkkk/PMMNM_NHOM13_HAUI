<?php

namespace Database\Factories;

use App\Models\AdminModel;
use App\Models\RolesModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
  /**
     * The name of the factory's corresponding model.
     *
     * 
     * Define the model's default state.
     *
     */
$factory->define(AdminModel::class, function (Faker $faker) {
    return [
        'admin_name' => $this->faker->name(),
        'admin_user' => $this->faker->unique()->safeEmail(),
        'admin_phone' => '0123456987',
        'password' => '25f9e794323b453885f5181f1b624d0b', // password
    ];
});
$factory->afterCreating(AdminModel::class, function ($admin, $faker) {
    $roles = RolesModel::where('name', 'user')->get();
    $admin->roles()->sync($roles->pluck('id_roles')->toArray());
});

