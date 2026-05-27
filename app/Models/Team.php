<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'team_name',    // <-- Wajib ada agar tidak dibuang Laravel
        'jenis_lomba',
        'username',
        'password',
        'status',
        'bukti_transfer_url',
    ];

    // Relasi ke Anggota (Satu tim memiliki banyak anggota)
    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }
}