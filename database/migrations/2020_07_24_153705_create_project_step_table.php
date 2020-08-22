<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectStepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_step', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unique(['project_id', 'step_id']);
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('step_id');
            $table->timestamp('validated_at')->nullable();
            $table->timestamps();
        });

        Schema::table('project_step', function (Blueprint $table) {
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->foreign('step_id')
                ->references('id')
                ->on('steps')
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
        Schema::table('project_step', function(Blueprint $table) {
            $table->dropUnique('project_step_project_id_step_id_unique');
            $table->dropForeign('project_step_project_id_foreign');
            $table->dropForeign('project_step_step_id_foreign');
        });
        Schema::dropIfExists('project_step');
    }
}
