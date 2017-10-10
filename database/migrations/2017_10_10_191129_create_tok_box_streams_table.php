<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokBoxStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tok_box_streams', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tok_box_connection_id');
            $table->string('video_type')->nullable();
            $table->string('value');
            $table->boolean('destroyed')->default(0);
            $table->string('destroy_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tok_box_streams');
    }
}
