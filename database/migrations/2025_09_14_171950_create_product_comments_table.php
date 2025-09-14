<?php

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
         Schema::create('product_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // কোন product
            $table->unsignedBigInteger('customer_id'); // কোন user/customer
            $table->unsignedBigInteger('parent_id')->nullable(); // reply হলে parent comment id
            $table->text('content'); // comment content
            $table->timestamps();

            // Foreign keys
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('product_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_comments');
    }
};
