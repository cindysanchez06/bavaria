<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->date('date');
            $table->string('file', 45);
            $table->bigInteger('employees_id');
            $table->foreign('employees_id')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('contracts', function(Blueprint $table)
        {
            $table->dropForeign('employees_id');
            $table->dropColumn('employees_id');
        });
        Schema::dropIfExists('contracts');
    }
}
