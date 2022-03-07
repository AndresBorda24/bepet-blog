<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Post_Tag', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');
            // Foreign Keys
            $table->foreign('post_id')
                ->references('id')
                ->on('Posts')
                ->onDelete('cascade');
            $table->foreign('tag_id')
                ->references('id')
                ->on('Tags')
                ->onDelete('cascade');
            // ---- 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Post_Tag');
    }
}
