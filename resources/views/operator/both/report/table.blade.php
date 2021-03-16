<style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    th, td {
      padding: 15px;
    }
</style>

<h1>Laporan Lelang {{ $tgl1 }} - {{ $tgl2 }}</h1>

<table style="width:100%">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Harga Awal</th>
        <th>Harga Akhir</th>
        <th>Pemenang</th>
        <th>Penginput</th>
        <th>Tanggal Lelang</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($auctions as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->item->name }}</td>
            <td>{{ $data->item->starting_price }}</td>
            <td>{{ $data->final_price }}</td>
            <td>
                @if ($data->bid !== null)
                    {{$data->bid->people->name}}
                @else
                    Belum ada
                @endif
            </td>
            <td>{{ $data->operator->name }}</td>
            <td>{{ $data->auction_date->format('Y-m-d') }}</td>
            <td>
                @if ($data->status === 'close')
                <span class="text-red-500 font-bold">Ditutup</span>  
                @else
                <span class="text-green-500 font-bold">Dibuka</span>  
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>