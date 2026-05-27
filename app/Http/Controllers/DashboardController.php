<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Mengambil tim yang sedang login
        $team = auth()->user();

        // Mengambil semua tim berdasarkan kategori untuk kebutuhan Leaderboard
        $allTeams = Team::with('members')->get();

        return view('arena.leaderboard', compact('team', 'allTeams'));
    }
}