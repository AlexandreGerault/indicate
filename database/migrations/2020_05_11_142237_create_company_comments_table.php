<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('diagnostic_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('content');
            $table->timestamps();
        });

        Schema::table('company_comments', function (Blueprint $table) {
            $table->foreign('diagnostic_id')
                ->references('id')
                ->on('company_diagnostics')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('company_need_categories')
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
        Schema::table('company_comments', function (Blueprint $table) {
            $table->dropForeign('company_comments_diagnostic_id_foreign');
            $table->dropForeign('company_comments_category_id_foreign');
        });
        Schema::dropIfExists('company_comments');
    }
}
