<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->text('aboutme')->nullable();
            $table->string('photo')->nullable();
            $table->bigInteger('memberid')->unsigned();
            $table->foreign('memberid')->references('id')->on('members')->onDelete('CASCADE');
            $table->boolean('hide')->default(0);
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
        Schema::dropIfExists('profiles');
    }
}
