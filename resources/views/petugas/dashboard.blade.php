<!DOCTYPE html>
<html><head><title>Petugas Dashboard</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-slate-50 min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow p-6 flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">🧑‍💼 Dashboard Petugas</h1>
                <p class="text-slate-500">Halo, {{ auth()->user()->name }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Logout</button>
            </form>
        </div>
        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
            <p class="text-amber-800">✅ Login berhasil! Role Anda: <strong>{{ auth()->user()->role }}</strong></p>
            <p class="text-amber-600 text-sm mt-2">Halaman dashboard petugas akan kita lengkapi di tahap berikutnya.</p>
        </div>
    </div>
</body></html>