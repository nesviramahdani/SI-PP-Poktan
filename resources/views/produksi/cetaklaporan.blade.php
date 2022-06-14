<h1>Data Produksi</h1>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Kelompok</th>
      <th scope="col">Komoditas</th>
      <th scope="col">Jumlah Produksi(ton)</th>
      <th scope="col">Luas Tanam(Ha)</th>
      <th scope="col">Tanggal Produksi</th>
    </tr>
  </thead>
      @php
        $no=1;
      @endphp
  <tbody>
      @foreach($cetakproduksi as $row)
    <tr>
      <th scope="row">{{ $no++ }}</th>
      <td>{{ $row->kelompoktani->nama_kelompoktani }}</td>
      <td>{{ $row->komoditas->nama_komoditas }}</td>
      <td>{{ $row->jumlah_produksi }}</td>
      <td>{{ $row->luas_tanam }}</td>
      <td>{{ $row->tanggal_produksi }}</td>
    </tr>
    @endforeach
  </tbody>
</table>