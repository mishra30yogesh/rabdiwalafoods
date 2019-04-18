<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesForEnquirySystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        
        Schema::create('user_type', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(TRUE);
                $table->timestamps();
        });
        
        Schema::table('user_type', function (Blueprint $table) {
            DB::table('user_type')->insert([
                [
                    'name' => 'admin',
                    'description' => 'admin',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'executive',
                    'description' => 'executive',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
        });
        
        Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name');
                $table->string('last_name')->nullable();
                $table->string('email')->unique();
                $table->string('password');
                $table->integer('user_type_id');
                $table->boolean('is_active')->default(TRUE);
                $table->boolean('is_deleted')->default(FALSE);;
                $table->integer('created_by');
                $table->integer('updated_by');
                $table->rememberToken();
                $table->timestamps();
        });
        
        Schema::table('users', function (Blueprint $table) {
            DB::table('users')->insert([
                [
                    'first_name' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('admin@123'),
                    'user_type_id' => '1',
                    'created_by' => '1',
                    'updated_by' => '1',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
            ]);
        });

        Schema::create('restaurant_type', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(TRUE);
                $table->timestamps();
        });
        
        Schema::table('restaurant_type', function (Blueprint $table) {
            DB::table('restaurant_type')->insert([
                [
                    'name' => 'Restaurant',
                    'description' => 'Restaurant',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Hotel + Restaurant',
                    'description' => 'Hotel + Restaurant',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Café',
                    'description' => 'Café',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Caterer',
                    'description' => 'Caterer',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'General Trade',
                    'description' => 'General Trade',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Modern Trade',
                    'description' => 'Modern Trade',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Others (Mention)',
                    'description' => 'Others (Mention)',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
        });

        Schema::create('contact_type', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(TRUE);
                $table->timestamps();
        });
        
        Schema::table('contact_type', function (Blueprint $table) {
            DB::table('contact_type')->insert([
                [
                    'name' => 'Owner',
                    'description' => 'Owner',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Manager',
                    'description' => 'Manager',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Chef',
                    'description' => 'Chef',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Cashier',
                    'description' => 'Cashier',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Others (Mention)',
                    'description' => 'Others (Mention)',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
        });

        Schema::create('samples', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(TRUE);
                $table->boolean('is_mixed');
                $table->timestamps();
        });
        
        Schema::table('samples', function (Blueprint $table) {
            DB::table('samples')->insert([
                [
                    'name' => 'Malai Rabdi',
                    'description' => 'Malai Rabdi',
                    'is_mixed' => FALSE,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Malai Basundi',
                    'description' => 'Malai Basundi',
                    'is_mixed' => FALSE,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Moong Dal Halwa',
                    'description' => 'Moong Dal Halwa',
                    'is_mixed' => FALSE,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Gulab Jamun',
                    'description' => 'Gulab Jamun',
                    'is_mixed' => FALSE,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Matka',
                    'description' => 'Matka',
                    'is_mixed' => FALSE,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Theplas with Aloo ki Sabzi',
                    'description' => 'Theplas with Aloo ki Sabzi',
                    'is_mixed' => TRUE,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Dal Bati Churma',
                    'description' => 'Dal Bati Churma',
                    'is_mixed' => TRUE,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Kaju Katli',
                    'description' => 'Kaju Katli',
                    'is_mixed' => TRUE,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Kesar Katli',
                    'description' => 'Kesar Katli',
                    'is_mixed' => TRUE,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Other (Mention)',
                    'description' => 'Other (Mention)',
                    'is_mixed' => FALSE,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
        });

        Schema::create('responses', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(TRUE);
                $table->timestamps();
        });
        
        Schema::table('responses', function (Blueprint $table) {
            DB::table('responses')->insert([
                [
                    'name' => 'Negative',
                    'description' => 'Negative',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Moderate',
                    'description' => 'Moderate',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Good',
                    'description' => 'Good',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Very Good',
                    'description' => 'Very Good',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Excellent',
                    'description' => 'Excellent',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
        });

        Schema::create('restaurant', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('restaurant_type_id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->text('address');
                $table->boolean('is_active')->default(TRUE);
                $table->integer('created_by');
                $table->timestamps();
        });

        Schema::create('restaurant_contact', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('restaurant_id');
                $table->integer('contact_type_id');
                $table->string('name');
                $table->string('email');
                $table->integer('contact');
                $table->integer('created_by');
                $table->timestamps();
        });

        Schema::create('feedbacks', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('restaurant_id');
                $table->integer('contact_id');
                $table->text('pin_location');
                $table->integer('created_by');
                $table->timestamps();
        });

        Schema::create('feedback_details', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('feedback_id');
                $table->integer('sample_id');
                $table->integer('responce_id');
                $table->text('remarks')->nullable();
                $table->boolean('is_active')->default(TRUE);
                $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
                $table->increments('id');
                $table->string('company_name');
                $table->text('address');
                $table->string('first_contact');
                $table->string('second_contact')->nullable();
                $table->integer('gstin')->nullable();
                $table->integer('contact_no');
                $table->integer('alternate_no')->nullable();
                $table->text('pin_location');
                $table->integer('created_by');
                $table->timestamps();
        });

        Schema::create('order_details', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('order_id');
                $table->integer('sample_id');
                $table->integer('quantity');
                $table->text('remark')->nullable();
                $table->boolean('is_active')->default(TRUE);
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_type');
        Schema::dropIfExists('restaurant_type');
        Schema::dropIfExists('contact_type');
        Schema::dropIfExists('samples');
        Schema::dropIfExists('responses');
        Schema::dropIfExists('restaurant');
        Schema::dropIfExists('restaurant_contact');
        Schema::dropIfExists('feedbacks');
        Schema::dropIfExists('feedback_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_details');
    }
}
