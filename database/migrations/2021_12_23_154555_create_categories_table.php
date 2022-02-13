<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            //id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY 
            // $table->bigInteger("id")->unsigned()->autoIncrement()->primary();
            // $table->unsignedBigInteger("id")->autoIncrement()->primary();
            // $table->bigIncrements("id")->primary();
            $table->id();

            //cahr (50),vchar (250) ,text
            $table->unsignedBigInteger("parent_id")->nullable();
            $table->foreign("parent_id")
            ->references("id")
            ->on("categories")
            ->onDelete("set null")
            ->onUpdate("set null");
            //RESTRICT ,CASCADE,SETNULL
            

            // $table->foreignId("parent_id")
            // ->nullable()
            // ->constrained("categories")
            // ->nullOnDelete();
            $table->string("name");
            $table->string("slug")->unique();
            $table->text("description")->nullable();
            $table->string("image")->nullable();

            //updated 
            //created
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
        Schema::dropIfExists('categories');
    }
}
