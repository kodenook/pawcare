<?php

use App\Models\Breed;
use App\Models\Type;
use App\Models\User;
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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->foreignIdFor(User::class, 'user_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Type::class, 'type_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Breed::class, 'breed_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('type_id', 'pets_type_id_breed_foreign')->references('type_id')->on('breeds')
                ->cascadeOnUpdate()->restrictOnDelete();

            $table->index('name', 'name_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
