<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticNeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic_need', function (Blueprint $table) {
            $table->primary(['diagnostic_id', 'need_id']);
            $table->unsignedBigInteger('diagnostic_id');
            $table->unsignedBigInteger('need_id');
            $table->timestamps();
        });

        Schema::table('diagnostic_need', function (Blueprint $table) {
            $table->foreign('diagnostic_id')->references('id')->on('diagnostics')->onDelete('cascade');
            $table->foreign('need_id')->references('id')->on('needs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diagnostic_need', function (Blueprint $table) {
            $table->dropPrimary('diagnostic_need_diagnostic_id_need_id_primary');
            $table->dropForeign('diagnostic_need_diagnostic_id_foreign');
            $table->dropForeign('diagnostic_need_need_id_foreign');
        });
        Schema::dropIfExists('diagnostic_need');
    }
}
