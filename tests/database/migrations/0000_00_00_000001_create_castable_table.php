<?php

namespace Grnspc\Locked\Tests\database;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('castables', function (Blueprint $table) {
            $table->id();
            $table->string('measure')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('castables');
    }
};
