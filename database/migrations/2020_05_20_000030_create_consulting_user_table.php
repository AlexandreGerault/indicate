<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultingUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulting_user', function (Blueprint $table) {
            $table->primary(['user_id', 'consulting_id']);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('consulting_id');
            $table->timestamps();
        });

        Schema::table('consulting_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('consulting_id')->references('id')->on('consultings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consulting_user', function (Blueprint $table) {
            $table->dropPrimary('consulting_user_user_id_consulting_id_primary');
            $table->dropForeign('consulting_user_user_id_foreign');
            $table->dropForeign('consulting_user_consulting_id_foreign');
        });
        Schema::dropIfExists('consulting_user');
    }
}
