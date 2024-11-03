<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSeasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_season', function (Blueprint $table) {
            $table->bigIncrements('id'); // 主キー
            $table->unsignedBigInteger('product_id')->nullable(false)->comment('商品ID');
            $table->unsignedBigInteger('season_id')->nullable(false)->comment('季節ID');
            $table->timestamps(); // created_at と updated_at カラムを自動作成

            // 外部キー制約
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');

            // 複合ユニークキーを設定
            $table->unique(['product_id', 'season_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_season');
    }
}
