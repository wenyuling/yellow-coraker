<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeixinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weixin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->default(null)->comment('用户id');
            $table->string('openid', 100)->default(0)->comment('微信openid');
            $table->string('nickname', 100)->default('')->comment("昵称");
            $table->enum('sex', [0, 1, 2])->default(0)->comment("性别，1：男、2：女、0：未知");
            $table->string('province', 100)->default('')->comment("省份");
            $table->string('city', 100)->default('')->comment("城市");
            $table->string('country', 100)->default('')->comment("国家，如中国为CN");
            $table->string('headimgurl')->default('')->comment("用户头像");
            $table->string('privilege')->nullable()->default(null)->comment('用户特权信息，json数组，如微信沃卡用户为（chinaunicom）');
            $table->string('unionid')->nullable()->default(null)->comment('用户统一标识');
            $table->timestamps();
            //索引
            $table->index('nickname');
            $table->unique('user_id');
        });
        DB::statement("ALTER TABLE `weixin` comment'第三方登录微信表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weixin');
    }
}
