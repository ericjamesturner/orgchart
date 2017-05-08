<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(file_get_contents(database_path('mysqldump.sql')));

        // CREATE TABLE `employees` (
        //     `id` int(11) NOT NULL AUTO_INCREMENT,
        //     `name` varchar(64) DEFAULT NULL,
        //     `bossId` int(11) DEFAULT NULL,
        //     PRIMARY KEY (`id`),
        //     KEY `name` (`name`),
        //     KEY `bossId` (`bossId`)
        // ) ENGINE=MyISAM AUTO_INCREMENT=20000 DEFAULT CHARSET=latin1;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
