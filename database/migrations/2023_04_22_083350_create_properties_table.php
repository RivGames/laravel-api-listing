<?php

use App\Enums\ListingTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Broker::class)->constrained();
            $table->string('address');
            $table->enum('listing_type',[
                ListingTypeEnum::OPEN->value,
                ListingTypeEnum::SELL->value,
                ListingTypeEnum::EXCLUSIVE->value,
                ListingTypeEnum::NET->value,
            ])->default(ListingTypeEnum::OPEN->value);
            $table->string('city');
            $table->string('zip_code');
            $table->longText('description');
            $table->year('build_year');
            $table->timestamps();
            $table->unique(['address','zip_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
