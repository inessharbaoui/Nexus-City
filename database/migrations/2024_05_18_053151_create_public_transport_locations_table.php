<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTransportLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_transport_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('public_transport_id');
            $table->integer('sequence');
            $table->string('location_name');
            $table->decimal('fee', 8, 2)->nullable();
            $table->boolean('online_payment')->default(false);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamp('arrival_time')->nullable();
            $table->timestamps();

            $table->foreign('public_transport_id')
                  ->references('id')
                  ->on('public_transport_data')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public_transport_locations');
    }
}
