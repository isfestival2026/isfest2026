<?php
namespace App\Models;

// Tambahkan baris ini:
use Illuminate\Foundation\Auth\User as Authenticatable; 

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Ubah 'extends Model' menjadi 'extends Authenticatable'
class Team extends Authenticatable 
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'team_name',
        'jenis_lomba',
        'username',
        'password',
        'status',
        'bukti_transfer_url',
    ];

    // Sembunyikan password saat data tim dipanggil
    protected $hidden = [
        'password',
    ];

    // Beritahu Laravel untuk hash password otomatis (jika pakai Laravel 10/11)
    protected $casts = [
        'password' => 'hashed',
    ];

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }
}