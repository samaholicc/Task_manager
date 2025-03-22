<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPositionToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('position')->nullable()->default(0)->after('completed');
        });

        // Set initial positions for existing tasks
        $tasks = DB::table('tasks')->orderBy('created_at')->get();
        foreach ($tasks as $index => $task) {
            DB::table('tasks')
                ->where('id', $task->id)
                ->update(['position' => $index + 1]);
        }
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
}