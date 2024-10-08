<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();  // 外部キー（categoriesテーブルへのリレーション）
            $table->string('first_name', 255);  // ファーストネーム
            $table->string('last_name', 255);  // ラストネーム
            $table->tinyInteger('gender');  // 性別 (1: 男性, 2: 女性, 3: その他)
            $table->string('email', 255);  // メールアドレス
            $table->string('tell', 255);  // 電話番号
            $table->string('address', 255);  // 住所
            $table->string('building', 255)->nullable();  // 建物名
            $table->text('detail');  // 詳細情報
            $table->timestamps();  // created_atとupdated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
