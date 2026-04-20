<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjamans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('jenis', ['terlambat', 'kehilangan', 'kerusakan']);
            $table->integer('hari_terlambat')->default(0);
            $table->bigInteger('nominal_denda');
            $table->text('keterangan_petugas')->nullable();
            $table->text('alasan_user')->nullable();
            $table->enum('status', ['belum_bayar', 'menunggu_konfirmasi', 'lunas'])->default('belum_bayar');
            $table->enum('metode_bayar', ['cash', 'qris'])->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->timestamp('dibayar_at')->nullable();
            $table->foreignId('dikonfirmasi_oleh')->nullable()->constrained('users');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('dendas'); }
};