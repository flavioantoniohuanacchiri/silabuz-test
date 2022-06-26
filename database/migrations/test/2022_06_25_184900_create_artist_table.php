<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 300)->index("IDX_ARTIST__NAME");
            $table->string('link', 1000)->nullable();
            $table->string('share', 1000)->nullable();
            $table->string('picture', 1000)->nullable();
            $table->string('picture_small', 1000)->nullable();
            $table->string('picture_medium', 1000)->nullable();
            $table->string('picture_big', 1000)->nullable();
            $table->string('picture_xl', 1000)->nullable();
            $table->integer('nb_album')->default(0);
            $table->bigInteger('nb_fan')->default(0);
            $table->boolean('radio')->default(false);
            $table->string('tracklist', 1000)->nullable();

            $table->dateTime("created_at")->nullable();
            $table->dateTime("updated_at")->nullable();
            $table->dateTime("deleted_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artist');
    }
}
