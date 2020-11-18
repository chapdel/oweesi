<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('list_id')->constrained();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("gender")->nullable();
            $table->string("zip_code")->nullable();
            $table->string("address")->nullable();
            $table->string("date")->nullable();
            $table->string("birthday")->nullable();
            $table->string("image")->nullable();
            $table->string("website")->nullable();
            $table->string("tags")->nullable();
            $table->enum("status", ['enabled', 'disabled'])->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
