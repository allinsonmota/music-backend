<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('ulr')->nullable();
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->foreign('artist_id')
                ->references('id')
                ->on('artists')
            ;
            $table->unsignedBigInteger('album_id')->nullable();
            $table->foreign('album_id')
                ->references('id')
                ->on('albums')
            ;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
