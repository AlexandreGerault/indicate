<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDiagnosticNeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_diagnostic_need', function (Blueprint $table) {
            $table->primary(['diagnostic_id', 'need_id']);
            $table->unsignedBigInteger('diagnostic_id');
            $table->unsignedBigInteger('need_id');
            $table->timestamps();
        });

        Schema::table('company_diagnostic_need', function (Blueprint $table) {
            $table->foreign('diagnostic_id')->references('id')->on('company_diagnostics')->onDelete('cascade');
            $table->foreign('need_id')->references('id')->on('company_needs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_diagnostic_need', function (Blueprint $table) {
            $table->dropPrimary('company_diagnostic_need_diagnostic_id_need_id_primary');
            $table->dropForeign('company_diagnostic_need_diagnostic_id_foreign');
            $table->dropForeign('company_diagnostic_need_need_id_foreign');
        });
        Schema::dropIfExists('company_diagnostic_need');
    }
}
