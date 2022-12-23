<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('company')->nullable();
            $table->text('location')->nullable();
            $table->text('ipaddress')->nullable();
            $table->mediumInteger('company_id')->nullable();
            $table->mediumInteger('location_id')->nullable();
            $table->text('unsolicited')->nullable();
            $table->text('flags')->nullable();
            $table->tinyInteger('visit_from_fb')->nullable();
            $table->tinyInteger('share_req')->nullable();
            $table->text('campaign')->nullable();
            $table->text('admin_email')->nullable();
            $table->text('coupon')->nullable();
            $table->timestamp('merchant_updated_timestamp')->nullable();
            $table->timestamp('merchant_created_timestamp')->nullable();
            $table->tinyInteger('imported')->nullable();
            $table->text('source')->nullable();
            $table->text('address')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('zip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
