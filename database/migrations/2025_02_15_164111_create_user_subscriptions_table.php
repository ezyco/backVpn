<?php

use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId(UserSubscription::user_id)
                  ->constrained((new User)->getTable())
                  ->cascadeOnDelete();
            $table->foreignId(UserSubscription::subscription_id)
                  ->constrained((new Subscription)->getTable())
                  ->cascadeOnDelete();
            $table->float(UserSubscription::size);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subscriptions');
    }
};
