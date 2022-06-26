<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("artist_id");

            $table->string('title', 300)->index("IDX_ALBUM__TITLE");
            $table->string('upc', 100)->nullable();
            $table->string('link', 1000)->nullable();
            $table->string('share', 1000)->nullable();
            $table->string('cover', 1000)->nullable();
            $table->string('cover_small', 1000)->nullable();
            $table->string('cover_medium', 1000)->nullable();
            $table->string('cover_big', 1000)->nullable();
            $table->string('cover_xl', 1000)->nullable();
            $table->string('md5_image', 500)->nullable();
            $table->string('label', 300)->nullable();
            $table->integer('nb_tracks')->default(0);
            $table->integer('duration')->default(0);
            $table->integer('fans')->default(0);
            $table->date('release_date')->nullable();
            $table->boolean('available')->default(true);
            $table->string('tracklist', 1000)->nullable();
            $table->boolean('explicit_lyrics')->default(false);
            $table->integer('explicit_content_lyrics')->default(0);
            $table->integer('explicit_content_cover')->default(0);

            $table->dateTime("created_at")->nullable();
            $table->dateTime("updated_at")->nullable();
            $table->dateTime("deleted_at")->nullable();
        });
        Schema::table('album', function (Blueprint $table) {
            $table->foreign('artist_id')
                ->references('id')
                ->on('artist');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album');
    }
}
