<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->default(\App\Models\Role::IS_USER);
            $table->unsignedBigInteger('avatar_id')->default(1);
            $table->rememberToken();
            $table->timestamps();
            // ----
            $table->foreign('role_id')
                ->references('id')
                ->on('Roles');
                
            $table->foreign('avatar_id')
                ->references('id')
                ->on('Avatars');
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
        Schema::dropIfExists('users');
    }
}
