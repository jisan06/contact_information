<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contact_information_id')->index();
            $table->string('address_name',255);
            $table->string('street',255);
            $table->string('zip_code',255);
            $table->string('state',255);
            $table->string('city',255);
            $table->string('country',255);
            $table->timestamps();

            $table->foreign('contact_information_id')->references('id')->on('contact_information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_addresses');
    }
}
