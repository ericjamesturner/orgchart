<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesClosureTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_closure', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->default(0);
            $table->integer('employee_id')->unsigned();
            $table->integer('depth')->unsigned();

            $table->index('parent_id');
            $table->index('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees_closure');
    }
}
