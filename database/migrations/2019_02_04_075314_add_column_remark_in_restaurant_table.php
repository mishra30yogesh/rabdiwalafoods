<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRemarkInRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurant', function (Blueprint $table) {
            $table->text('remarks')->nullable();
        });
        
        Schema::table('restaurant_contact', function (Blueprint $table) {
            $table->text('remarks')->nullable();
            $table->text('contact')->change();
        });
        
        Schema::table('order_details', function (Blueprint $table) {
            $table->renameColumn('sample_id', 'product_id');
        });
        
        Schema::create('products', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(TRUE);
                $table->timestamps();
        });
        
        Schema::table('products', function (Blueprint $table) {
            DB::table('products')->insert([
                [
                    'name' => 'Malai Rabdi (Kg)',
                    'description' => 'Malai Rabdi',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Malai Basundi (Kg)',
                    'description' => 'Malai Basundi',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Moong Dal Halwa (Kg)',
                    'description' => 'Moong Dal Halwa',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Gulab Jamun',
                    'description' => 'Gulab Jamun',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Matka (Pcs)',
                    'description' => 'Matka',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Theplas with Aloo ki Sabzi (24 Pcs)',
                    'description' => 'Theplas with Aloo ki Sabzi',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Dal Bati Churma (16 Pcs)',
                    'description' => 'Dal Bati Churma',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Mix Box - Theplas with Aloo ki Sabzi (12 Pcs) & Dal Bati Churma (8 Pcs)',
                    'description' => 'Dal Bati Churma',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Kaju Katli 250gm (24 Pcs)',
                    'description' => 'Kaju Katli',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Kaju Katli 500gm (16 Pcs)',
                    'description' => 'Kaju Katli',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Mix Box - Kaju Katli 250g (12 Pcs) & Kaju Katli 500g (8 Pcs)',
                    'description' => 'Kaju Katli',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Kesar Katli 250gm (24 Pcs)',
                    'description' => 'Kesar Katli',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Kesar Katli 500gm (16 Pcs)',
                    'description' => 'Kesar Katli',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Mix Box - Kesar Katli 250g (12 Pcs) & Kesar Katli 500g (8 Pcs)',
                    'description' => 'Kesar Katli',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Other (Mention)',
                    'description' => 'Other (Mention)',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurant', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
        
        Schema::table('restaurant_contact', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
        
        Schema::dropIfExists('products');
    }
}
