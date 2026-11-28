<?php

use App\Models\Anggota;
use App\Models\Pertemuan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// ==================== DASHBOARD ====================
Route::get('/', function () {
    $anggota = Anggota::with('user')->latest()->take(5)->get();
    $pertemuan = Pertemuan::latest('tanggal')->take(5)->get();
    $totalAnggota = Anggota::count();
    $totalAktif = Anggota::where('status', 'aktif')->count();
    return view('admin-dashboard', compact('anggota', 'pertemuan', 'totalAnggota', 'totalAktif'));
});

// ==================== ANGGOTA ====================
Route::get('/anggota', function () {
    $search = request('q');
    $filterKelas = request('kelas');
    $filterStatus = request('status');

    $anggota = Anggota::with('user')
        ->when($search, fn($q) => $q->where(fn($q) =>
            $q->where('nama_lengkap', 'like', "%{$search}%")
              ->orWhere('nit', 'like', "%{$search}%")
        ))
        ->when($filterKelas, fn($q) => $q->where('kelas_jurusan', 'like', "%{$filterKelas}%"))
        ->when($filterStatus, fn($q) => $q->where('status', $filterStatus))
        ->latest()->paginate(10)->withQueryString();

    $totalAnggota  = Anggota::count();
    $totalAktif    = Anggota::where('status', 'aktif')->count();
    $totalNonaktif = Anggota::where('status', 'nonaktif')->count();
    $totalKelas    = Anggota::distinct('kelas_jurusan')->count('kelas_jurusan');
    $kelasList     = Anggota::distinct()->pluck('kelas_jurusan')->filter()->values();

    return view('anggota', compact('anggota', 'totalAnggota', 'totalAktif', 'totalNonaktif', 'totalKelas', 'kelasList'));
});

Route::get('/anggota/ekspor', function () {
    $search = request('q');
    $filterKelas = request('kelas');
    $filterStatus = request('status');

    $anggota = Anggota::when($search, fn($q) => $q->where(fn($q) =>
            $q->where('nama_lengkap', 'like', "%$search%")
              ->orWhere('nit', 'like', "%$search%")
        ))
        ->when($filterKelas, fn($q) => $q->where('kelas_jurusan', 'like', "%$filterKelas%"))
        ->when($filterStatus, fn($q) => $q->where('status', $filterStatus))
        ->orderBy('nit', 'asc')
        ->get();

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="data-anggota-itsen-' . date('Y-m-d') . '.csv"',
    ];

    $callback = function () use ($anggota) {
        $file = fopen('php://output', 'w');
        fputs($file, "\xEF\xBB\xBF");
        fputcsv($file, ['No', 'NIT', 'Nama Lengkap', 'Kelas & Jurusan', 'No HP', 'Status']);
        foreach ($anggota as $i => $a) {
            fputcsv($file, [
                $i + 1,
                $a->nit,
                $a->nama_lengkap,
                $a->kelas_jurusan,
                $a->no_hp ?: '-',
                ucfirst($a->status),
            ]);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
});

Route::get('/anggota/tambah', function () {
    return view('anggota-tambah');
});

Route::post('/anggota', function () {
    $data = request()->validate([
        'nama_lengkap'  => ['required', 'string', 'max:100'],
        'nit'           => ['required', 'string', 'max:20', 'unique:anggota,nit'],
        'kelas_jurusan' => ['required', 'string', 'max:100'],
        'no_hp'         => ['nullable', 'string', 'max:20'],
        'password'      => ['required', 'string', 'min:8'],
    ]);

    DB::transaction(function () use ($data) {
        $user = User::create([
            'nama'                 => $data['nama_lengkap'],
            'username'             => $data['nit'],
            'password'             => Hash::make($data['password']),
            'role'                 => 'anggota',
            'is_active'            => true,
            'must_change_password' => true,
        ]);
        Anggota::create([
            'user_id'       => $user->id,
            'nit'           => $data['nit'],
            'nama_lengkap'  => $data['nama_lengkap'],
            'kelas_jurusan' => $data['kelas_jurusan'],
            'no_hp'         => $data['no_hp'] ?? null,
            'status'        => 'aktif',
        ]);
    });

    return redirect('/anggota')->with('success', 'Anggota berhasil ditambahkan.');
});

Route::get('/anggota/{id}/edit', function (int $id) {
    $anggota = Anggota::findOrFail($id);
    return view('anggota-edit', compact('anggota'));
});

Route::post('/anggota/{id}', function (int $id) {
    $anggota = Anggota::findOrFail($id);
    $data = request()->validate([
        'nama_lengkap'  => ['required', 'string', 'max:100'],
        'kelas_jurusan' => ['required', 'string', 'max:100'],
        'no_hp'         => ['nullable', 'string', 'max:20'],
    ]);

    DB::transaction(function () use ($anggota, $data) {
        $anggota->update([
            'nama_lengkap'  => $data['nama_lengkap'],
            'kelas_jurusan' => $data['kelas_jurusan'],
            'no_hp'         => $data['no_hp'] ?? null,
        ]);
        $anggota->user->update(['nama' => $data['nama_lengkap']]);
    });

    return redirect('/anggota')->with('success', 'Data anggota berhasil diperbarui.');
});

Route::post('/anggota/{id}/status', function (int $id) {
    $anggota = Anggota::findOrFail($id);
    $status = $anggota->status === 'aktif' ? 'nonaktif' : 'aktif';
    $anggota->update(['status' => $status]);
    $anggota->user->update(['is_active' => $status === 'aktif']);
    return redirect('/anggota')->with('success', 'Status anggota ' . $anggota->nama_lengkap . ' diubah menjadi ' . $status . '.');
});

Route::post('/anggota/{id}/reset-password', function (int $id) {
    $anggota = Anggota::findOrFail($id);
    $data = request()->validate([
        'password' => ['required', 'string', 'min:8'],
    ]);
    $anggota->user->update([
        'password'             => Hash::make($data['password']),
        'must_change_password' => true,
    ]);
    return redirect('/anggota')->with('success', 'Password ' . $anggota->nama_lengkap . ' berhasil direset.');
});

Route::post('/anggota/{id}/hapus', function (int $id) {
    $anggota = Anggota::findOrFail($id);
    DB::transaction(function () use ($anggota) {
        $user = $anggota->user;
        $anggota->delete();
        if ($user) {
            $user->delete();
        }
    });
    return redirect('/anggota')->with('success', 'Anggota berhasil dihapus.');
});

// ==================== PERTEMUAN ====================
Route::get('/pertemuan', function () {
    $search = request('q');
    $filterStatus = request('status');
    $sort = request('sort', 'terbaru');

    $mappedStatus = match ($filterStatus) {
        'dibuka', 'berjalan' => 'berjalan',
        'draft', 'terjadwal' => 'terjadwal',
        'ditutup', 'selesai' => 'selesai',
        default => null,
    };

    $query = Pertemuan::with(['pembuat', 'absensi'])
        ->when($search, fn($q) => $q->where(fn($sub) =>
            $sub->where('judul', 'like', "%{$search}%")
                ->orWhere('catatan', 'like', "%{$search}%")
        ))
        ->when($mappedStatus, fn($q) => $q->where('status', $mappedStatus));

    if ($sort === 'terlama') {
        $query->orderBy('tanggal', 'asc');
    } else {
        $query->orderByRaw("CASE WHEN status = 'berjalan' THEN 0 WHEN status = 'selesai' THEN 1 ELSE 2 END")
              ->orderBy('tanggal', 'desc');
    }

    $pertemuan = $query->paginate(4)->withQueryString();

    $total     = Pertemuan::count();
    $berjalan  = Pertemuan::where('status', 'berjalan')->count();
    $terjadwal = Pertemuan::where('status', 'terjadwal')->count();
    $selesai   = Pertemuan::where('status', 'selesai')->count();

    return view('pertemuan', compact('pertemuan', 'total', 'berjalan', 'terjadwal', 'selesai'));
});

Route::get('/pertemuan/tambah', function () {
    $maxNum = 0;
    foreach (Pertemuan::all() as $p) {
        if (preg_match('/(?:Pertemuan\s*)?(\d+)/i', $p->judul, $m)) {
            $num = (int) $m[1];
            if ($num > $maxNum) {
                $maxNum = $num;
            }
        }
    }
    $nextNum = $maxNum > 0 ? $maxNum + 1 : (Pertemuan::count() + 1);
    $defaultJudul = "Pertemuan {$nextNum}: ";

    return view('pertemuan-tambah', compact('nextNum', 'defaultJudul'));
});

Route::post('/pertemuan', function () {
    $data = request()->validate([
        'judul'           => ['required', 'string', 'max:150'],
        'tanggal'         => ['required', 'date'],
        'jam_mulai'       => ['required'],
        'jam_selesai'     => ['required'],
        'toleransi_menit' => ['required', 'integer', 'min:0', 'max:120'],
        'catatan'         => ['nullable', 'string'],
    ]);

    $judul = trim($data['judul']);
    if (!preg_match('/^Pertemuan\s*[\d\-]+/i', $judul)) {
        $maxNum = 0;
        foreach (Pertemuan::all() as $p) {
            if (preg_match('/(?:Pertemuan\s*)?(\d+)/i', $p->judul, $m)) {
                $num = (int) $m[1];
                if ($num > $maxNum) {
                    $maxNum = $num;
                }
            }
        }
        $nextNum = $maxNum > 0 ? $maxNum + 1 : (Pertemuan::count() + 1);
        $judul = "Pertemuan {$nextNum}: " . $judul;
    }

    $aksi = request('aksi');
    $status = ($aksi === 'buka') ? 'berjalan' : 'terjadwal';
    $dibukaPada = ($aksi === 'buka') ? now() : null;

    $admin = User::where('role', 'admin')->first();

    Pertemuan::create([
        'judul'           => $judul,
        'tanggal'         => $data['tanggal'],
        'jam_mulai'       => $data['jam_mulai'],
        'jam_selesai'     => $data['jam_selesai'],
        'toleransi_menit' => $data['toleransi_menit'],
        'catatan'         => $data['catatan'] ?? null,
        'status'          => $status,
        'dibuka_pada'     => $dibukaPada,
        'dibuat_oleh'     => $admin?->id,
    ]);

    return redirect('/pertemuan')->with('success', 'Pertemuan berhasil ' . ($status === 'berjalan' ? 'dibuat dan dibuka!' : 'dijadwalkan.'));
});

Route::get('/pertemuan/{id}/edit', function (int $id) {
    $pertemuan = Pertemuan::findOrFail($id);
    preg_match('/(?:Pertemuan\s*)?(\d+)/i', $pertemuan->judul, $m);
    $pNum = isset($m[1]) ? $m[1] : $pertemuan->id;

    return view('pertemuan-edit', compact('pertemuan', 'pNum'));
});

Route::post('/pertemuan/{id}', function (int $id) {
    $pertemuan = Pertemuan::findOrFail($id);
    $data = request()->validate([
        'judul'           => ['required', 'string', 'max:150'],
        'tanggal'         => ['required', 'date'],
        'jam_mulai'       => ['required'],
        'jam_selesai'     => ['required'],
        'toleransi_menit' => ['required', 'integer', 'min:0', 'max:120'],
        'catatan'         => ['nullable', 'string'],
    ]);

    $judul = trim($data['judul']);
    if (!preg_match('/^Pertemuan\s*[\d\-]+/i', $judul)) {
        preg_match('/(?:Pertemuan\s*)?(\d+)/i', $pertemuan->judul, $m);
        $pNum = isset($m[1]) ? $m[1] : $pertemuan->id;
        $judul = "Pertemuan {$pNum}: " . $judul;
    }
    $data['judul'] = $judul;

    $pertemuan->update($data);
    return redirect('/pertemuan')->with('success', 'Pertemuan berhasil diperbarui.');
});

Route::post('/pertemuan/{id}/buka', function (int $id) {
    $pertemuan = Pertemuan::findOrFail($id);
    $pertemuan->update([
        'status'      => 'berjalan',
        'dibuka_pada' => now(),
    ]);
    return redirect('/pertemuan')->with('success', 'Sesi pertemuan "' . $pertemuan->judul . '" berhasil dibuka!');
});

Route::post('/pertemuan/{id}/tutup', function (int $id) {
    $pertemuan = Pertemuan::findOrFail($id);
    $pertemuan->update([
        'status'       => 'selesai',
        'ditutup_pada' => now(),
        'cara_tutup'   => 'manual',
    ]);
    return redirect('/pertemuan')->with('success', 'Sesi pertemuan "' . $pertemuan->judul . '" berhasil ditutup.');
});

Route::post('/pertemuan/{id}/hapus', function (int $id) {
    $pertemuan = Pertemuan::findOrFail($id);
    $pertemuan->delete();
    return redirect('/pertemuan')->with('success', 'Pertemuan berhasil dihapus.');
});

Route::get('/pertemuan/{id}', function (int $id) {
    $pertemuan = Pertemuan::with(['pembuat'])->findOrFail($id);
    $tab = request('tab', 'sudah');
    $search = request('q');
    $statusFilter = request('status', 'semua');

    // If this pertemuan has no attendance records, clone from template pertemuan 1
    if (DB::table('absensi')->where('pertemuan_id', $id)->count() === 0) {
        $templateRecords = DB::table('absensi')->where('pertemuan_id', 1)->get();
        foreach ($templateRecords as $rec) {
            $newRec = (array) $rec;
            unset($newRec['id']);
            $newRec['pertemuan_id'] = $id;
            DB::table('absensi')->insert($newRec);
        }
    }

    $totalSiswa = Anggota::count();
    if ($totalSiswa < 40) {
        $totalSiswa = 40;
    }

    $hadirCount = DB::table('absensi')->where('pertemuan_id', $id)->where('status', 'hadir')->count();
    $terlambatCount = DB::table('absensi')->where('pertemuan_id', $id)->where('status', 'terlambat')->count();
    $izinCount = DB::table('absensi')->where('pertemuan_id', $id)->where('status', 'izin')->count();
    $sakitCount = DB::table('absensi')->where('pertemuan_id', $id)->where('status', 'sakit')->count();
    $totalRecorded = $hadirCount + $terlambatCount + $izinCount + $sakitCount;
    $alpaCount = max(0, $totalSiswa - $totalRecorded);
    $persentase = $totalSiswa > 0 ? round(($totalRecorded / $totalSiswa) * 100, 1) : 0;

    // Query for "Sudah Absen"
    $sudahQuery = DB::table('absensi')
        ->join('anggota', 'absensi.anggota_id', '=', 'anggota.id')
        ->where('absensi.pertemuan_id', $id)
        ->select(
            'absensi.*',
            'anggota.nama_lengkap',
            'anggota.nit',
            'anggota.kelas_jurusan',
            'anggota.no_hp'
        )
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('anggota.nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('anggota.nit', 'like', "%{$search}%")
                    ->orWhere('anggota.kelas_jurusan', 'like', "%{$search}%");
            });
        })
        ->when($statusFilter && $statusFilter !== 'semua', function ($q) use ($statusFilter) {
            $q->where('absensi.status', $statusFilter);
        })
        ->orderBy('absensi.id', 'asc');

    $sudahAbsenList = $sudahQuery->paginate(6, ['*'], 'page')->withQueryString();

    // Query for "Belum Absen"
    $attendedAnggotaIds = DB::table('absensi')->where('pertemuan_id', $id)->pluck('anggota_id');
    $belumQuery = Anggota::whereNotIn('id', $attendedAnggotaIds)
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nit', 'like', "%{$search}%")
                    ->orWhere('kelas_jurusan', 'like', "%{$search}%");
            });
        })
        ->orderBy('id', 'asc');

    $belumAbsenList = $belumQuery->paginate(6, ['*'], 'page_belum')->withQueryString();

    return view('pertemuan-detail', compact(
        'pertemuan',
        'tab',
        'search',
        'statusFilter',
        'totalSiswa',
        'hadirCount',
        'terlambatCount',
        'izinCount',
        'sakitCount',
        'alpaCount',
        'totalRecorded',
        'persentase',
        'sudahAbsenList',
        'belumAbsenList'
    ));
});

Route::get('/pertemuan/{id}/ekspor', function (int $id) {
    $pertemuan = Pertemuan::findOrFail($id);
    $records = DB::table('absensi')
        ->join('anggota', 'absensi.anggota_id', '=', 'anggota.id')
        ->where('absensi.pertemuan_id', $id)
        ->select(
            'anggota.nit',
            'anggota.nama_lengkap',
            'anggota.kelas_jurusan',
            'absensi.status',
            'absensi.waktu_absen',
            'absensi.jarak_meter',
            'absensi.keterangan'
        )
        ->orderBy('absensi.id', 'asc')
        ->get();

    $csv = "ï»¿";
    $csv .= "No,NIT/NIS,Nama Siswa,Kelas,Status Kehadiran,Waktu Presensi,Jarak GPS (Meter),Keterangan\n";
    $no = 1;
    foreach ($records as $r) {
        $csv .= sprintf(
            "%d,\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"\n",
            $no++,
            $r->nit,
            str_replace('"', '""', $r->nama_lengkap),
            $r->kelas_jurusan,
            ucfirst($r->status),
            $r->waktu_absen,
            $r->jarak_meter ?? '-',
            str_replace('"', '""', $r->keterangan ?? '-')
        );
    }

    $filename = 'Presensi_' . str_replace([' ', ':', '/'], '_', $pertemuan->judul) . '_' . date('Ymd_His') . '.csv';

    return response($csv)
        ->header('Content-Type', 'text/csv; charset=UTF-8')
        ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
});

// ==================== FITUR LAINNYA ====================
Route::get('/absensi', function () { return view('absensi'); });
Route::get('/absensi/{id}', function (int $id) { return view('absensi-detail', ['id' => $id]); });
Route::get('/rekap', function () { return view('rekap'); });
Route::get('/pengajuan', function () { return view('pengajuan'); });
Route::get('/pengajuan/{id}', function (int $id) { return view('pengajuan-detail', ['id' => $id]); });

Route::get('/pengaturan-lokasi', function () { return view('pengaturan-lokasi'); });
Route::post('/pengaturan-lokasi', function () {
    $data = request()->validate([
        'lokasi_nama'       => ['required', 'string', 'max:255'],
        'latitude'          => ['required', 'numeric', 'between:-90,90'],
        'longitude'         => ['required', 'numeric', 'between:-180,180'],
        'radius_meter'      => ['required', 'integer', 'between:10,1000'],
        'akurasi_maks_meter'=> ['required', 'integer', 'between:1,1000'],
    ]);
    foreach ($data as $kunci => $nilai) {
        DB::table('pengaturan')->updateOrInsert(
            ['kunci' => $kunci],
            ['nilai' => (string) $nilai, 'updated_at' => now(), 'created_at' => now()],
        );
    }
    return redirect('/pengaturan-lokasi')->with('success', 'Pengaturan lokasi berhasil disimpan.');
});
