<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => "admin",
        'email' => 'admin@gmail.com',
        'password' => '$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju', // password
        'type' => 0, //0 for admin and 1 for user
        'phone' => $faker->phoneNumber,
        'dob' => $faker->date,
        'address' => $faker->address,
        'profile' => Str::random(10) . '.jpg',
        'create_user_id' => 1,
        'updated_user_id' => 1,
        'created_at' => now(),
    ];
});
$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => "Meet to the top ",
        'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores ipsa nulla eius quibusdam atque, cumque excepturi eum? Minima quis perspiciatis dignissimos praesentium corrupti aliquid? Vitae, molestiae impedit? Quidem, labore dolore!
",
        'status' => 1,
        'create_user_id' => 1,
        'updated_user_id' => 3,
        'created_at' => now(),
    ];
});
