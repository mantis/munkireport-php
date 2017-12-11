<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class Reportdata extends Migration
{
    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->create('reportdata', function (Blueprint $table) {
            $table->increments('id');

            $table->string('serial_number')->unique();
            $table->string('console_user')->nullable();
            $table->string('long_username')->nullable();
            $table->string('remote_ip');
            $table->integer('uptime')->nullable()->default(0);
            $table->integer('reg_timestamp')->nullable();
            $table->integer('machine_group')->nullable()->default(0);
            $table->timestamps();

            $table->index(['console_user']);
            $table->index(['long_username']);
            $table->index(['remote_ip']);
            $table->index(['machine_group']);

        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('reportdata');
    }
}
