<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('monthly_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');
            $table->string('status')->default('draft')->index(); // draft, published
            $table->json('metrics')->nullable();
            $table->json('completed_work')->nullable();
            $table->json('next_month_plan')->nullable();
            $table->text('summary')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->unique(['client_id', 'project_id', 'month', 'year'], 'client_project_month_year_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monthly_reports');
    }
};
