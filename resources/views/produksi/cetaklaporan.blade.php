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
    @page { size: A4 }
  
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
       <center><font>Data Produksi pada Dinas Pertanian Kota Padang dari {{ $data['tanggal_mulai'] }}sampai {{ $data['tanggal_selesai'] }}</font></center><br>
        <table class="table">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>Nama Kelompok Tani</th>
                    <th>Komoditas</th>
                    <th>Jumlah Produksi(ton)</th>
                    <th>Luas Tanam(ha)</th>
                    <th>Tanggal Produksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['cetakproduksi'] as $p)
                <tr>
                    <td class="text-center" width="20">{{ $loop->iteration }}</td>
                    <td>{{ $p->kelompoktani->nama_kelompoktani }}</td>
                    <td>{{ $p->komoditas->nama_komoditas }}</td>
                    <td class="text-center">{{ $p->jumlah_produksi }}</td>
                    <td class="text-center">{{ $p->luas_tanam }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($p->tanggal_produksi)->format('d/m/Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>
</html>