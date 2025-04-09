<div class="p-6 bg-black rounded-2xl shadow-md space-y-6">
    <h2 class="text-lg font-bold text-black border-b border-gray-300 pb-2">📊 Detail Transaksi</h2>

    <div class="grid md:grid-cols-2 gap-6 text-sm">
        <div>
            <p class="text-black font-semibold">📅 Tanggal</p>
            <p class="text-black font-medium">
                {{ \Carbon\Carbon::parse($record->tanggal_transaksi)->translatedFormat('d F Y') }}
            </p>
        </div>
        <div>
            <p class="text-black font-semibold">🔁 Jenis Transaksi</p>
            <span class="inline-block px-3 py-1 rounded-full text-white text-xs font-semibold
                {{ $record->jenis_transaksi === 'pemasukan' ? 'bg-green-600' : 'bg-red-600' }}">
                {{ ucfirst($record->jenis_transaksi) }}
            </span>
        </div>
        <div>
            <p class="text-black font-semibold">💰 Jumlah</p>
            <p class="text-black font-semibold text-base">
                Rp {{ number_format($record->jumlah_transaksi, 2, ',', '.') }}
            </p>
        </div>
        <div>
            <p class="text-black font-semibold">🏷️ Kategori</p>
            <p class="text-black">{{ $record->kategori->nama_kategori ?? '-' }}</p>
        </div>
        <div>
            <p class="text-black font-semibold">🏢 Departemen</p>
            <p class="text-black">{{ $record->departemen->nama_departemen ?? '-' }}</p>
        </div>
        <div>
            <p class="text-black font-semibold">🗂️ Proyek</p>
            <p class="text-black">{{ $record->proyek->nama_proyek ?? '-' }}</p>
        </div>
    </div>

    <div>
        <p class="text-black font-semibold">📝 Deskripsi</p>
        <div class="text-gray-700 whitespace-pre-line border border-gray-300 p-3 rounded-md bg-gray-50">
            {{ $record->deskripsi ?? '-' }}
        </div>
    </div>
    

    @if($record->bukti_pendukung)
        <div>
            <p class="text-black font-semibold">📎 Bukti Pendukung</p>
            <a href="{{ asset('storage/' . $record->bukti_pendukung) }}"
               target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-black bg-blue-600 hover:bg-blue-700 rounded-md transition">
                📂 Lihat File
            </a>
        </div>
    @endif
</div>
