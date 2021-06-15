<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_status', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_package')
                ->unsigned();
            $table->bigInteger('id_status')
                ->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_package')
                ->references('id')
                ->on('packages')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_status')
                ->references('id')
                ->on('status')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_status');
    }
}
