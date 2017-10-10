<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokBoxConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tok_box_connections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tok_box_token_id');
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
        Schema::dropIfExists('tok_box_connections');
    }
}
