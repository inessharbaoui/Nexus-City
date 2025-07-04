

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id();
            $table->string('location_name');
            $table->decimal('longitude', 10, 8);
            $table->decimal('latitude', 10, 8);
            $table->timestamp('timestamp');
            $table->decimal('temperature', 5, 2);
            $table->decimal('precipitation', 5, 2);
            $table->decimal('wind_speed', 5, 2);
            $table->decimal('wind_direction', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse
     * the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_data');
    }
}
