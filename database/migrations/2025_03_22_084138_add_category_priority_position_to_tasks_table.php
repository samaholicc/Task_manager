<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryPriorityPositionToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('category')->nullable()->after('heure_echeance');
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium')->after('category');
            $table->integer('position')->default(0)->after('completed');
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['category', 'priority', 'position']);
        });
    }
}