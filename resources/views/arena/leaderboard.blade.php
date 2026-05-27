<x-layout.app title="Dashboard Arena">
<div x-data="{ activeTab: 'Data Competition' }" class="max-w-7xl mx-auto px-6 py-12">

    {{-- Tabs Navigation --}}
    <div class="bg-[#0b1120] p-1 rounded-xl border border-slate-700/50 flex w-fit mb-8">
        <button @click="activeTab = 'Data Competition'" 
                :class="activeTab === 'Data Competition' ? 'bg-[#172135] text-emerald-400' : 'text-slate-500'"
                class="px-6 py-2.5 rounded-lg text-xs font-bold uppercase tracking-widest transition">
            Data Competition
        </button>
        <button @click="activeTab = 'UI/UX'" 
                :class="activeTab === 'UI/UX' ? 'bg-[#172135] text-blue-400' : 'text-slate-500'"
                class="px-6 py-2.5 rounded-lg text-xs font-bold uppercase tracking-widest transition">
            UI/UX
        </button>
    </div>

    {{-- Tabel Dinamis (Looping Data dari Controller) --}}
    <div class="bg-[#151e2e] border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <table class="w-full text-left text-sm text-slate-400">
            <thead class="bg-[#1a2436] text-slate-300 uppercase text-[10px] tracking-widest">
                <tr>
                    <th class="px-6 py-4">Tim</th>
                    <th class="px-6 py-4">Status Submisi</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700/50">
                @foreach($allTeams as $t)
                <tr x-show="activeTab === '{{ $t->jenis_lomba }}'">
                    <td class="px-6 py-4 font-bold text-white">{{ $t->team_name }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded bg-slate-700 text-[10px]">
                            {{ $t->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="text-amber-500 hover:text-amber-300 font-bold">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
</x-layout.app>