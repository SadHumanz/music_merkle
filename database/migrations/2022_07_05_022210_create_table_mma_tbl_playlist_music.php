<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_mma_tbl_playlist_music', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('playlist_id')->constrained('playlist')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('music_id')->constrained('music')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_mma_tbl_playlist_music');
    }
};
