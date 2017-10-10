<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokBoxTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tok_box_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tok_box_session_id');
            $table->string('value', 1024);
            $table->string('data');
            $table->enum('role', [\OpenTok\Role::PUBLISHER, \OpenTok\Role::SUBSCRIBER, \OpenTok\Role::MODERATOR]);
            $table->dateTime('expires_at');
            $table->index('data');
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
        Schema::dropIfExists('tok_box_tokens');
    }
}
