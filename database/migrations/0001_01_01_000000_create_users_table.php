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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'anggota'])->default('anggota')->index();
            $table->boolean('is_active')->default(true);
            $table->boolean('must_change_password')->default(true);
            $table->dateTime('privasi_disetujui_pada')->nullable();
            $table->string('privasi_versi', 10)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('periode', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->unique();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->boolean('is_aktif')->default(false)->index();
            $table->timestamps();
        });

        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->restrictOnDelete();
            $table->string('nis', 20)->unique();
            $table->string('nama_lengkap', 100);
            $table->string('kelas', 20)->index();
            $table->string('jurusan', 50)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->index();
            $table->timestamps();
        });

        Schema::create('pertemuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('periode')->restrictOnDelete();
            $table->string('judul', 150);
            $table->date('tanggal')->index();
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->unsignedSmallInteger('toleransi_menit')->default(15);
            $table->enum('status', ['draft', 'dibuka', 'ditutup'])->default('draft')->index();
            $table->dateTime('dibuka_pada')->nullable();
            $table->dateTime('ditutup_pada')->nullable();
            $table->enum('cara_tutup', ['manual', 'otomatis'])->nullable();
            $table->text('catatan')->nullable();
            $table->foreignId('dibuat_oleh')->constrained('users')->restrictOnDelete();
            $table->timestamps();
            $table->index(['tanggal', 'status']);
            $table->index(['periode_id', 'tanggal']);
        });

        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('kunci', 50)->unique();
            $table->string('nilai');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('pengajuan_izin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertemuan_id')->constrained('pertemuan')->restrictOnDelete();
            $table->foreignId('anggota_id')->constrained('anggota')->restrictOnDelete();
            $table->enum('jenis', ['izin', 'sakit']);
            $table->string('alasan');
            $table->string('lampiran_path')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'dibatalkan'])->default('menunggu')->index();
            $table->foreignId('diproses_oleh')->nullable()->constrained('users')->restrictOnDelete();
            $table->dateTime('diproses_pada')->nullable();
            $table->string('catatan_pengurus')->nullable();
            $table->timestamps();
            $table->unique(['pertemuan_id', 'anggota_id']);
            $table->index(['status', 'created_at']);
        });

        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertemuan_id')->constrained('pertemuan')->restrictOnDelete();
            $table->foreignId('anggota_id')->constrained('anggota')->restrictOnDelete();
            $table->enum('status', ['hadir', 'terlambat', 'izin', 'sakit', 'alpa'])->index();
            $table->enum('sumber_status', ['anggota', 'sistem', 'pengurus', 'pengajuan']);
            $table->dateTime('waktu_absen')->nullable();
            $table->string('foto_path')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('akurasi_gps', 8, 2)->nullable();
            $table->decimal('jarak_meter', 8, 2)->nullable();
            $table->unsignedSmallInteger('radius_saat_absen')->nullable();
            $table->boolean('perlu_diperiksa')->default(false)->index();
            $table->string('keterangan')->nullable();
            $table->foreignId('diubah_oleh')->nullable()->constrained('users')->restrictOnDelete();
            $table->foreignId('pengajuan_id')->nullable()->constrained('pengajuan_izin')->restrictOnDelete();
            $table->timestamps();
            $table->unique(['pertemuan_id', 'anggota_id']);
            $table->index(['pertemuan_id', 'status']);
        });

        Schema::create('log_penolakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertemuan_id')->constrained('pertemuan')->restrictOnDelete();
            $table->foreignId('anggota_id')->constrained('anggota')->restrictOnDelete();
            $table->enum('alasan', ['di_luar_radius', 'akurasi_buruk']);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('akurasi_gps', 8, 2)->nullable();
            $table->decimal('jarak_meter', 8, 2)->nullable();
            $table->unsignedSmallInteger('radius_saat_percobaan')->nullable();
            $table->timestamp('created_at')->useCurrent()->index();
            $table->index(['pertemuan_id', 'anggota_id']);
        });

        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->string('aksi', 50)->index();
            $table->string('objek_tipe', 50)->nullable();
            $table->unsignedBigInteger('objek_id')->nullable();
            $table->json('data_lama')->nullable();
            $table->json('data_baru')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at')->useCurrent()->index();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
        Schema::dropIfExists('log_penolakan');
        Schema::dropIfExists('pengajuan_izin');
        Schema::dropIfExists('absensi');
        Schema::dropIfExists('pertemuan');
        Schema::dropIfExists('pengaturan');
        Schema::dropIfExists('periode');
        Schema::dropIfExists('anggota');
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
