<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('auth.daftar');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'kategori' => 'required|in:UI/UX,Data Competition,Mobile Legends,Valorant',
            'nama_tim' => 'required|string|max:255|unique:teams,team_name',
            'password' => 'required|string|min:6',
            'nama_ketua' => 'required|string|max:255',
            'wa_ketua' => 'required|string|max:25',
            'instansi_ketua' => 'required|string|max:255',
            'ktm_ketua' => 'required|file|image|max:5120',
            'bukti_transfer' => 'required|file|image|max:5120',
            'nama_anggota' => 'nullable|array',
            'nama_anggota.*' => 'nullable|string|max:255',
            'ktm_anggota' => 'nullable|array',
            'ktm_anggota.*' => 'nullable|file|image|max:5120',
        ]);

        DB::beginTransaction();

        try {
            $username = Str::lower(str_replace(' ', '_', $request->nama_tim));
            
            // PENYESUAIAN: Membuat slug kategori (Misal: "UI/UX" menjadi "ui-ux", "Data Competition" menjadi "data-competition")
            $categorySlug = Str::slug($request->kategori);
            
            // PENYESUAIAN: Folder dikelompokkan berdasarkan kategori lomba -> username tim
            $teamFolder = 'pendaftaran/' . $categorySlug . '/' . $username;

            // 2. Upload Bukti Transfer ke Folder Tim yang Baru
            $extTransfer = $request->file('bukti_transfer')->getClientOriginalExtension();
            $buktiPath = $request->file('bukti_transfer')->storeAs($teamFolder, 'bukti_transfer.' . $extTransfer, 's3');
            
            if (!$buktiPath) {
                throw new \Exception('Gagal mengunggah Bukti Transfer ke Cloud Storage.');
            }
            $buktiTransferUrl = Storage::disk('s3')->url($buktiPath);

            // 3. Buat Record Tim
            $team = Team::create([
                'jenis_lomba'        => $request->kategori, 
                'team_name'          => $request->nama_tim, 
                'username'           => $username,
                'password'           => Hash::make($request->password),
                'status'             => 'pending',
                'bukti_transfer_url' => $buktiTransferUrl,
            ]);

            // 4. Upload KTM Ketua ke Folder Tim yang Baru
            $extKetua = $request->file('ktm_ketua')->getClientOriginalExtension();
            $ktmKetuaPath = $request->file('ktm_ketua')->storeAs($teamFolder, 'ktm_ketua.' . $extKetua, 's3');
            
            if (!$ktmKetuaPath) {
                throw new \Exception('Gagal mengunggah foto KTM Ketua.');
            }
            $ktmKetuaUrl = Storage::disk('s3')->url($ktmKetuaPath);

            TeamMember::create([
                'team_id'       => $team->id,
                'nama_lengkap'  => $request->nama_ketua,
                'no_whatsapp'   => $request->wa_ketua,
                'asal_instansi' => $request->instansi_ketua,
                'ktm_url'       => $ktmKetuaUrl,
                'is_captain'    => true,
            ]);

            // 5. Upload KTM Anggota ke Folder Tim yang Baru
            if ($request->has('nama_anggota') && is_array($request->nama_anggota)) {
                foreach ($request->nama_anggota as $index => $namaAnggota) {
                    if (!empty($namaAnggota)) {
                        if ($request->hasFile("ktm_anggota.$index")) {
                            $fileKtmAnggota = $request->file("ktm_anggota")[$index];
                            
                            $extAnggota = $fileKtmAnggota->getClientOriginalExtension();
                            $filenameAnggota = 'ktm_anggota_' . ($index + 1) . '.' . $extAnggota;
                            
                            $ktmAnggotaPath = $fileKtmAnggota->storeAs($teamFolder, $filenameAnggota, 's3');
                            
                            if (!$ktmAnggotaPath) {
                                throw new \Exception("Gagal mengunggah foto KTM Anggota: $namaAnggota.");
                            }
                            $ktmAnggotaUrl = Storage::disk('s3')->url($ktmAnggotaPath);

                            TeamMember::create([
                                'team_id'       => $team->id,
                                'nama_lengkap'  => $namaAnggota,
                                'no_whatsapp'   => $request->wa_ketua, 
                                'asal_instansi' => $request->instansi_ketua,
                                'ktm_url'       => $ktmAnggotaUrl,
                                'is_captain'    => false,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('daftar')->with('success', 'Mantra pendaftaran berhasil dikirim! Username Anda: ' . $username);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Gerbang pendaftaran gagal dibuka: ' . $e->getMessage()]);
        }
    }
}