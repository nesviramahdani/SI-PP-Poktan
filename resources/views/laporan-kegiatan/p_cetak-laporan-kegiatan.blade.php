<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cetak Data Rencana Kegiatan</title>
   <font size="1"><i> 
   @php
   $mytime = Carbon\Carbon::now();
   echo $mytime->toDateTimeString();
   @endphp</i></font>
<style>
    @page { size: A4 landscape}
  
    h1 {
        font-weight: bold;
        font-size: 20pt;
        text-align: center;
    }
  
    table {
        border-collapse: collapse;
        width: 100%;
    }
  
    .table th {
        padding: 8px 8px;
        border:1px solid #000000;
        text-align: center;
    }
  
    .table td {
        padding: 3px 3px;
        border:1px solid #000000;
    }
  
    .text-center {
        text-align: center;
    }
</style>
</head>
<body class="A4">
    <section class="sheet padding-10mm">
      <br><center><font size="4">RENCANA KEGIATAN/KUNJUNGAN BULANAN PENYULUH PERTANIAN</font></center><br>
      <font>Nomor :</font>
      <table align="left">
      <td>
        <font>Kepada Yth,</font><br>
        <font>Bpk Kepala Dinas Pertanian Kota Padang</font><br>
        <font>Di</font><br>
        <font>Padang</font><br>
      </td>
      </table>
       <br>
       <center><font>Data Laporan Kegiatan Kelompok Tani pada Dinas Pertanian Kota Padang dari {{ $data['tanggal_mulai'] }} sampai {{ $data['tanggal_selesai'] }}</font></center><br>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Hari/Tgl</th>
                <th scope="col">Kegiatan/Materi</th>
                <th scope="col">Peserta</th>
                <th scope="col">Kelompoktani</th>
                <th scope="col">Hasil</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data['cetaklaporan'] as $p)
              <tr>
                <td class="text-center">{{ $loop->iteration }}.</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($p->kegiatan->tanggal_kegiatan)->format('l/d m Y')}}</td>
                <td>{{ $p->kegiatan->nama_kegiatan }}</td>
                <td class="text-center">{{ $p->peserta }}</td>
                <td>{{ $p->kelompoktani->nama_kelompoktani }}</td>
                <td>{{ $p->hasil }}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
    </section>
</body>
</html>

