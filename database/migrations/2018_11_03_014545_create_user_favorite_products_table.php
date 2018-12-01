<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFavoriteProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_favorite_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')
                ->comment('级联删除, 一旦删除了用户,所关联的用户收藏也会删除');
            $table->unsignedInteger('product_id')->comment('产品id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')
                ->comment('级联删除, 一旦删除了商品,所关联的用户商品也会删除');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `weixin` comment'用户关联商品表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_favorite_products');
    }
}
