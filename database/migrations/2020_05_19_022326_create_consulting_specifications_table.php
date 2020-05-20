<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultingSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulting_specifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('consulting_id');
            $table->text('content');
            $table->timestamps();
        });

        Schema::table('consulting_specifications', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('consulting_skill_categories')
                ->onDelete('cascade');

            $table->foreign('consulting_id')
                ->references('id')
                ->on('consultings')
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
        Schema::table('consulting_specifications', function (Blueprint $table) {
            $table->dropForeign('consulting_specifications_category_id_foreign');
            $table->dropForeign('consulting_specifications_consulting_id_foreign');
        });
        Schema::dropIfExists('consulting_specifications');
    }
}
