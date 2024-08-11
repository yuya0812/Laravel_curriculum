<?php 

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'category' => $faker->word,
        'store_name' => $faker->company,
        'location' => $faker->address,
        'title' => $faker->sentence,
        'comment' => $faker->paragraph,
        'genre' => $faker->word,
        'images' => json_encode([$faker->imageUrl()])
    ];
});
