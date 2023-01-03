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
        Schema::create('phones', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedInteger('user_id');
            $table->string("name");
            $table->text("description");
            $table->string("mark");
            $table->integer("ram");
            $table->integer("battery");
            $table->float("price");
            $table->integer("back_camera");
            $table->integer("front_camera");
            $table->string("color")->nullable();
            $table->integer("storage");
            $table->string("processor")->nullable();
            $table->string("reviews")->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
};
