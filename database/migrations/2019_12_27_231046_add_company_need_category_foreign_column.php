<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyNeedCategoryForeignColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_needs', function (Blueprint $table) {
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
        Schema::table('company_needs', function (Blueprint $table) {
            $table->dropForeign('company_needs_category_id_foreign');
        });
    }
}
