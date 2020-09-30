<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tusk', function (Blueprint $table) {
            $table->bigIncrements('No');
            $table->string('id');
            $table->varchar('name');
            $table->varchar('userid');
            $table->string('view');
            $table->string('status');
            $table->string('sakujo');
            $table->date('enddate');
            $table->date('limitdate');
            $table->timestamps('insdate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
