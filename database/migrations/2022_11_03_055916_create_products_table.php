<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->longText('short_desc')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('keywords')->default('Product Description');
            $table->longText('technical_specification')->nullable();
            $table->string('photo');
            $table->double('price')->default(0);
            $table->longText('warranty')->default('No Warranty');
            $table->Integer('status')->default(1);
            $table->integer('Stock')->default(0);
            $table->integer('quantity')->default(1)->nullable();
            $table->longText('is_promo')->default(0);
            $table->longText('is_featured')->default(0);
            $table->longText('is_tranding')->default(0);

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

        $table->unsignedBigInteger('brand_id');
        $table->foreign('brand_id')
            ->references('id')
            ->on('brands');


            $table->unsignedBigInteger('tax_id');
            $table->foreign('tax_id')
                ->references('id')
                ->on('taxes');


























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
        Schema::dropIfExists('products');
    }
}
