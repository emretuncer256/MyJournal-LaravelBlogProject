<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 4; $i++) {
            $title = $faker->realText(rand(10, 30));
            DB::table('articles')->insert([
                'category_id' => rand(1, 8),
                'title' => $title,
                'image' => $faker->imageUrl(1920, 1080, 'cats', true, 'Faker'),
                'content' => $faker->realText(rand(256, 872)),
                'slug' => Str::slug($title),
                'created_at' => $faker->dateTime(),
                'updated_at' => now(),
                'status' => true
            ]);
        }
    }
}
