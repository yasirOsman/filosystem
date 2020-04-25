<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name',256);
            $table->string('color',256);
            $table->enum('category',['pet','phone','jewellery']);
            $table->string('description',256)->nullable();
            $table->string('image',256)->nullable();
            $table->unsignedBigInteger('user_found')->unsigned();
            $table->foreign('user_found')->references('id')->on('users');
            $table->string('place_found');
            $table->datetime('found_time');
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
        Schema::dropIfExists('items');
    }
}
