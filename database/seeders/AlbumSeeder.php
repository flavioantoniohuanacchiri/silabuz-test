<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Faker\Generator;
use App\Models\Album;

class AlbumSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for($i = 0; $i < 100; $i++) {
            $albumObj = new Album;
            $albumObj->artist_id = $faker->numberBetween(1, 100);
            $albumObj->title = strtoupper($faker->name);
            $albumObj->save();
            $albumObj->upc = $faker->randomNumber(8);
            $albumObj->share = route("album.show", ["id" => $albumObj->id])."?utm_source=deezer&utm_content=album-{$albumObj->id}&utm_term=0_1656207095&utm_medium=web";
            $albumObj->cover = $faker->imageUrl(1920, 1920, "album");
            $albumObj->cover_small = $faker->imageUrl(56, 56, "album");
            $albumObj->cover_medium = $faker->imageUrl(250, 250, "album");
            $albumObj->cover_big = $faker->imageUrl(500, 500, "album");
            $albumObj->cover_xl = $faker->imageUrl(1000, 1000, "album");
            $albumObj->label = $faker->streetAddress();
            $albumObj->nb_tracks = $faker->randomNumber(2);
            $albumObj->duration = $faker->randomNumber(5);
            $albumObj->fans = $faker->randomNumber(8);
            $albumObj->release_date = $faker->date();
            $albumObj->tracklist = route("album.trackList", ["id" => $albumObj->id]);
            $albumObj->explicit_content_lyrics = $faker->numberBetween(0, 7);
            $albumObj->explicit_content_cover = $faker->numberBetween(0, 7);
            $albumObj->save();
        }
    }
}
