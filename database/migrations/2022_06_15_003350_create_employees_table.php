<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\Types;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->integer('phone');
            $table->string('address', 45);
            $table->bigInteger('types_id')->unsigned();
            $table->foreign('types_id')->references('id')->on('types')->onDelete('cascade');

            //$table->bigInteger('types_id');
            //$table->foreign('types_id')->references('id')->on('types')->onDelete('cascade');
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
        Schema::table('employees', function(Blueprint $table)
        {
            $table->dropForeign('types_id');
            $table->dropColumn('types_id');
        });
        Schema::dropIfExists('employees');
    }
}
