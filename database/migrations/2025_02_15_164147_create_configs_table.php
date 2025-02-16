<?php

use App\Models\Config;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string(Config::country);
            $table->string(Config::location);
            $table->string(Config::countryFlag);
            $table->boolean(Config::active)->default(true);
            $table->boolean(Config::special)->default(false);
            $table->string(Config::configFile);
            $table->string(Config::type);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
