<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->integer('seats_available');
            $table->decimal('fee', 8, 2);
            $table->decimal('departure_latitude', 10, 8);
            $table->decimal('departure_longitude', 11, 8);
            $table->string('departure_location');
            $table->decimal('arrival_latitude', 10, 8);
            $table->decimal('arrival_longitude', 11, 8);
            $table->string('arrival_location');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
