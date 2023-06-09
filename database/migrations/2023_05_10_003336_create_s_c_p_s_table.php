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
        Schema::create('s_c_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('strength');
            $table->string('unit_of_issue');
            $table->string('unit_size');
            $table->string('available_units');
            $table->string('requested_units');
            $table->string('allocated_units');

            $table->string('requested_by');
            $table->string('request_date');
            $table->string('status');
            $table->string('request_id');
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
        Schema::dropIfExists('s_c_p_s');
    }
};
