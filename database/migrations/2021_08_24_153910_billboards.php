<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Billboards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billboards', function (Blueprint $table) {
            $table->bigIncrements('id_item')->comment("ID");
            $table->string('name_item')->comment("Наименование");
            $table->boolean("type_item")->comment("Тип стат-дин")->default(false);
            $table->boolean("light_item")->comment("Свет")->default(false);
            $table->float("price_item", 8, 2)->comment("Стоимость")->default(0.0);
            $table->float("make_price_item", 8, 2)->comment("Стоимость создания")->default(0.0);
            $table->float("mount_price_item", 8, 2)->comment("Стоимость аренды")->default(0.0);
            $table->text("photo_a_item")->comment("Фото A")->nullable();
            $table->text("photo_b_item")->comment("Фото B")->nullable();
            $table->text("location_item")->comment("Расположение")->nullable();
            $table->text("tech_item")->comment("Тех")->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_actions');
    }
}
