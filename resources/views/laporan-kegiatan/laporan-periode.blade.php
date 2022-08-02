<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cetak Data Produksi</title>
   <font size="1"><i> 
   @php
   $mytime = Carbon\Carbon::now();
   echo $mytime->toDateTimeString();
   @endphp</i></font>
<style>
    @page { size: A4 landscape }
  
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
       <table>
         <tr>
           <td>
            <center>
              <font size="4">PEMERINTAH KOTA PADANG</font>
              <br>
              <font size="6">DINAS PERTANIAN</font><br>
              <font size="2">Jln.Sungai Lareh Lubuk Minturun&emsp;&emsp;&emsp;&emsp;Telp & Fax (0751)495892</font><br>
              <font size="2">Email:dipertakotapadang@gmail.com&emsp;&emsp;&emsp;&emsp;</font>
          </center>
           </td>
         </tr>
         <tr>
           <td colspan="2"><hr></td>
         </tr>
       </table>
       <br>
       <center><font>Data Laporan Kegiatan Kelompok Tani pada Dinas Pertanian Kota Padang dari ...sampai...</font></center><br>
        <table class="table">
            <thead>
                <tr>
                  <th>No.</th>
                  <th>Kelompok tani</th>
                  <th>Kegiatan</th>
                  <th>Tanggal</th>
                  <th>Kehadiran</th>
                  <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
              @foreach($laporankegiatan as $row)
              <tr>
                  <td class="text-center">{{ $loop->iteration }}.</td>
                  <td>{{ $row->kelompoktani->nama_kelompoktani }}</td>
                  <td>{{ $row->kegiatan->nama_kegiatan }}</td>
                  <td class="text-center">{{ \Carbon\Carbon::parse($row->kegiatan->tanggal_kegiatan)->format('d/m/Y')}}</td>
                  <td class="text-center">{{ $row->peserta }}</td>
                  <td>{{ $row->hasil}}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
    </section>
</body>
</html>



