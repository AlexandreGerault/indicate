<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultingSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulting_skill', function (Blueprint $table) {
            $table->primary(['consulting_id', 'skill_id']);
            $table->unsignedBigInteger('consulting_id');
            $table->unsignedBigInteger('skill_id');
            $table->timestamps();
        });

        Schema::table('consulting_skill', function (Blueprint $table) {
            $table->foreign('consulting_id')
                ->references('id')
                ->on('consultings')
                ->onDelete('cascade');

            $table->foreign('skill_id')
                ->references('id')
                ->on('consulting_skills')
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
        Schema::table('consulting_skill', function (Blueprint $table) {
            $table->dropPrimary('consulting_skill_consulting_id_skill_id_primary');
            $table->dropForeign('consulting_skill_consulting_id_foreign');
            $table->dropForeign('consulting_skill_skill_id_foreign');
        });
        Schema::dropIfExists('consulting_skill');
    }
}
