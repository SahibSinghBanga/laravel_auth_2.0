<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Todo;

class AddUserIdColumnAndForeignConstraintToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Todo::truncate();

        Schema::table('todos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); 
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
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
