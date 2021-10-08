<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->integer('number_of_foot');
            $table->string('suara');
            $table->text('description');
            $table->timestamps();
            $table->integer('is_delete')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
