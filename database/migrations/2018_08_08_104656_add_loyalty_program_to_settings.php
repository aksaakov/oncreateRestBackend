<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoyaltyProgramToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function(Blueprint $table)
        {
            $table->integer('loyalty_points_per_order')->default(10);
            $table->integer('loyalty_points_for_reward')->default(100);
            $table->float('loyalty_reward_amount')->default(16);
            $table->integer('loyalty_points_per_amount')->default(16);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function(Blueprint $table)
        {
            $table->dropColumn(['loyalty_points_per_order', 'loyalty_points_for_reward', 'loyalty_reward_amount', 'loyalty_points_per_amount']);
        });
    }
}
