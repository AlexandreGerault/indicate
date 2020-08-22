<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConsultingSkillsRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consulting_skills', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('consulting_skill_categories')
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
        Schema::table('consulting_skills', function (Blueprint $table) {
            $table->dropForeign('consulting_skills_category_id_foreign');
        });
    }
}
