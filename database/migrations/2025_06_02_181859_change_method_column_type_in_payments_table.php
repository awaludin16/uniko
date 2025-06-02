<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Gunakan DB::statement karena mengubah enum ke string tidak didukung langsung oleh schema builder
        DB::statement("ALTER TABLE payments MODIFY method VARCHAR(255) NULL");
    }

    public function down()
    {
        // Balikkan ke enum jika diperlukan (opsional)
        DB::statement("ALTER TABLE payments MODIFY method ENUM('QRIS', 'Cash', 'Debit') NULL");
    }
};
