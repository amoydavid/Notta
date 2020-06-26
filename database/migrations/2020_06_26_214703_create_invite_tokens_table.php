<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInviteTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invite_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('invite_uid')->default(0)->comment('发起者');
            $table->string('token', '100')->unique();
            $table->bigInteger('accept_uid')->default(0)->comment('使用者');
            $table->string('resource_type')->default('')->comment('资源类型');
            $table->bigInteger('resource_id')->default(0)->comment('资源id');
            $table->dateTime('expired_at')->nullable()->comment('有效期');
            $table->dateTime('used_at')->nullable()->comment('使用时间');
            $table->smallInteger('status')->default(0)->comment('使用状态 0未用 1已用');
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
        Schema::dropIfExists('invite_tokens');
    }
}
