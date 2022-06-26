<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatetrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("artist_id");
            $table->unsignedBigInteger("album_id");

            $table->boolean('readable')->default(true);
            $table->string('title', 300)->index("IDX_TRACK__TITLE")->nullable();
            $table->string('title_short', 300)->index("IDX_TRACK__TITLE_SHORT")->nullable();
            $table->string('title_version', 300)->index("IDX_TRACK__TITLE_VERSION")->nullable();
            $table->string('isrc', 20)->index("IDX_TRACK__ISRC")->nullable();
            $table->string('link', 1000)->nullable();
            $table->string('share', 1000)->nullable();
            $table->integer('duration')->default(0);
            $table->integer('track_position')->default(0);
            $table->integer('disk_number')->default(0);
            $table->integer('rank')->default(0);
            $table->date('release_date')->nullable();
            $table->boolean('explicit_lyrics')->default(false);
            $table->integer('explicit_content_lyrics')->default(0);
            $table->integer('explicit_content_cover')->default(0);
            $table->string('preview', 1000)->nullable();
            $table->decimal('bpm', 4, 1)->nullable();
            $table->decimal('gain', 4, 1)->nullable();
            $table->string('md5_image', 500)->nullable();

            $table->dateTime("created_at")->nullable();
            $table->dateTime("updated_at")->nullable();
            $table->dateTime("deleted_at")->nullable();
        });
        Schema::table('track', function (Blueprint $table) {
            $table->foreign('artist_id')
                ->references('id')
                ->on('artist');
            $table->foreign('album_id')
                ->references('id')
                ->on('album');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track');
    }
}
