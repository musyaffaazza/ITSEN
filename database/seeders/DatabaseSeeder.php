<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Pertemuan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nama' => 'Admin ITSEN',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_active' => true,
            'must_change_password' => false,
        ]);

        // Anggota
        $anggota = [
            ['nit' => '20260001', 'nama_lengkap' => 'Budi Santoso',   'kelas_jurusan' => 'XI PPLG 1', 'no_hp' => '0812-3456-7890', 'status' => 'aktif'],
            ['nit' => '20260002', 'nama_lengkap' => 'Siti Rahma',     'kelas_jurusan' => 'XI PPLG 2', 'no_hp' => '0813-9876-5432', 'status' => 'aktif'],
            ['nit' => '20260003', 'nama_lengkap' => 'Ahmad Fauzi',    'kelas_jurusan' => 'XI TKJ 1',  'no_hp' => '0821-1122-3344', 'status' => 'aktif'],
            ['nit' => '20260004', 'nama_lengkap' => 'Nadia Putri',    'kelas_jurusan' => 'XI PPLG 1', 'no_hp' => '0857-4455-6677', 'status' => 'aktif'],
            ['nit' => '20260005', 'nama_lengkap' => 'Farhan Maulana', 'kelas_jurusan' => 'XII PPLG 1','no_hp' => '0896-5544-3322', 'status' => 'nonaktif'],
        ];

        foreach ($anggota as $a) {
            $user = User::create([
                'nama'                => $a['nama_lengkap'],
                'username'            => $a['nit'],
                'password'            => Hash::make('password123'),
                'role'                => 'anggota',
                'is_active'           => $a['status'] === 'aktif',
                'must_change_password'=> true,
            ]);
            Anggota::create([
                'user_id'      => $user->id,
                'nit'          => $a['nit'],
                'nama_lengkap' => $a['nama_lengkap'],
                'kelas_jurusan'=> $a['kelas_jurusan'],
                'no_hp'        => $a['no_hp'],
                'status'       => $a['status'],
            ]);
        }

                // Pertemuan contoh
        $admin = User::where('username', 'admin')->first();
        $adminId = $admin?->id ?? 1;
        $pertemuans = [
            ['judul' => 'Pertemuan 12: Dasar Laravel & Routing Web API', 'tanggal' => '2026-11-20', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'berjalan', 'catatan' => 'Lab Komputer 2 (Gedung B, Lt. 3) • Radius 50m • Pembina: M. Rizky, S.Kom'],
            ['judul' => 'Pertemuan 11: Konsep REST API & JSON Serialization', 'tanggal' => '2026-11-13', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'selesai', 'catatan' => 'Lab Komputer 2'],
            ['judul' => 'Pertemuan 10: Git Branching & Collaborative Workflow di GitHub', 'tanggal' => '2026-11-06', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'selesai', 'catatan' => 'Lab Komputer 2'],
            ['judul' => 'Pertemuan 13: Database & Relasi Tabel MySQL', 'tanggal' => '2026-11-27', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'terjadwal', 'catatan' => 'Lab Komputer 2 (Gedung B, Lt. 3) • Radius 50m • Pembina: M. Rizky, S.Kom'],
            ['judul' => 'Pertemuan 14: Laravel Authentication, Middleware & Security', 'tanggal' => '2026-12-04', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'terjadwal', 'catatan' => 'Lab Komputer 2 • Pembina: M. Rizky, S.Kom'],
            ['judul' => 'Pertemuan 9: JavaScript DOM & Event Handling Interaktif', 'tanggal' => '2026-10-30', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'selesai', 'catatan' => 'Lab Komputer 2'],
            ['judul' => 'Pertemuan 8: Modern JavaScript ES6+ & Async Await', 'tanggal' => '2026-10-23', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'selesai', 'catatan' => 'Lab Komputer 2'],
            ['judul' => 'Pertemuan 7: Responsive Web Design & Tailwind CSS', 'tanggal' => '2026-10-16', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'selesai', 'catatan' => 'Lab Komputer 1'],
            ['judul' => 'Pertemuan 6: CSS Grid & Flexbox Layout Modern', 'tanggal' => '2026-10-09', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'selesai', 'catatan' => 'Lab Komputer 1'],
            ['judul' => 'Pertemuan 5: Dasar HTML5 Semantik & Struktur Web Standar', 'tanggal' => '2026-10-02', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'selesai', 'catatan' => 'Lab Komputer 1'],
            ['judul' => 'Pertemuan 4: Konsep Jaringan Komputer, IP & Subnetting', 'tanggal' => '2026-09-25', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'selesai', 'catatan' => 'Lab Komputer 2'],
            ['judul' => 'Pertemuan 3: Instalasi & Konfigurasi Linux Server untuk Web', 'tanggal' => '2026-09-18', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'toleransi_menit' => 15, 'status' => 'selesai', 'catatan' => 'Lab Komputer 2'],
        ];

        foreach ($pertemuans as $p) {
            Pertemuan::create([
                'judul'           => $p['judul'],
                'tanggal'         => $p['tanggal'],
                'jam_mulai'       => $p['jam_mulai'],
                'jam_selesai'     => $p['jam_selesai'],
                'toleransi_menit' => $p['toleransi_menit'],
                'status'          => $p['status'],
                'catatan'         => $p['catatan'] ?? null,
                'dibuat_oleh'     => $adminId,
            ]);
        }
    }
}
