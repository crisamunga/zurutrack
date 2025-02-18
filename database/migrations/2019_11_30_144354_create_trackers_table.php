<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('serial')->unique();
            $table->boolean('online')->default(false);
            $table->boolean('enabled')->default(true);
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->datetime('added_on')->useCurrent();
            $table->datetime('expires_on');
            $table->bigInteger('tracker_model_id')->nullable()->unsigned();
            $table->bigInteger('added_by_id')->nullable()->unsigned();
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
        Schema::dropIfExists('trackers');
    }
}
