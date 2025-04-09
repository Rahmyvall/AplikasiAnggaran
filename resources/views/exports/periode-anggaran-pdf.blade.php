<!DOCTYPE html>
<html>
<head>
    <title>Periode Anggaran</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Daftar Periode Anggaran</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Periode</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Berakhir</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->nama_periode }}</td>
                    <td>{{ $item->tanggal_mulai }}</td>
                    <td>{{ $item->tanggal_berakhir }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $item->status)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
