<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('provider_name')->nullable();
            $table->string('image')->nullable();
            $table->integer('capacity')->default(0);
            $table->integer('fixed');
            $table->integer('price');
            $table->integer('minute');
            $table->integer('hour')->nullable();
            $table->integer('distance');
            $table->enum('calculator', ['MIN', 'HOUR', 'DISTANCE', 'DISTANCEMIN', 'DISTANCEHOUR']);
            $table->string('description')->nullable();
            $table->double('weight', 15, 8)->nullable();
            $table->double('width', 15, 8)->nullable();
            $table->double('height', 15, 8)->nullable();
            $table->enum('type', ['PERSON', 'LOAD'])->default('PERSON');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('service_types');
    }
}