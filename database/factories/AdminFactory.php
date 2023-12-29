<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin;
use App\Models\Role;

$factory->define(Admin::class, function () {
    $faker = Faker\Factory::create('vi_VN');

    return [
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'user_name'      => $faker->name,
        'email'          => $faker->unique()->freeEmail,
        'password'       => bcrypt('Test123'),
        'avatar'         => $faker->image('public/uploads/avatar',478,575,null,false),
        'phone'          => $faker->e164PhoneNumber,
        'address'        => $faker->streetAddress,
        'gender'         => $faker->boolean,
        'status'         => 1
    ];
});

$factory->afterCreating(Admin::class, function($admin, $faker){
    $roles = Role::where('name', 'user')->get();
    $admin->roles()->sync($role->pluck('id')->toArray());
});
