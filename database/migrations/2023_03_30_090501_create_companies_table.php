<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('logo')
                ->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number', 17);
            $table->string('mobile_phone_number', 17);
            $table->string('street')
                ->nullable();
            $table->string('state')
                ->nullable();
            $table->string('city')
                ->nullable();
            $table->string('postal_code')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
