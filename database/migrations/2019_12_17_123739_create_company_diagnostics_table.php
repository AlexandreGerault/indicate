<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDiagnosticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_diagnostics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->uuid('uuid')->default(uniqid());
            $table->integer('step')->default(1);
            $table->timestamps();
        });

        Schema::table('company_diagnostics', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_diagnostics', function (Blueprint $table) {
            $table->dropForeign('company_diagnostics_user_id_foreign');
        });
        Schema::dropIfExists('company_diagnostics');
    }
}
