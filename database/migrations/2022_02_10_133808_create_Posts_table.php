<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200)->unique();
            $table->tinyText('extract');
            $table->mediumText('body');
            $table->enum('status', ['BORRADOR', 'PUBLICADO', 'ARCHIVADO'])->default('BORRADOR');
            $table->string('slug');
            $table->unsignedBigInteger('user_id');
            $table->foreignId('category_id')->nullable()->constrained('Categories')->nullOnDelete();
            $table->timestamp('posted_at')->nullable();
            $table->timestamps();
            // --- Foreign keys
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            
            // 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Posts');
    }
}
