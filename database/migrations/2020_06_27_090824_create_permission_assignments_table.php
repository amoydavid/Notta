<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_type', 100)->default('')->comment('用户类型');
            $table->bigInteger('user_id')->default(0)->comment('用户id');
            $table->string('resource_type', 100)->default('')->comment('资源类型');
            $table->bigInteger('resource_id')->default(0)->comment('资源id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_assignments');
    }
}
