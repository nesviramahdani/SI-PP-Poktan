<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cetak Laporan Kegiatan</title>
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
      <br><center><font size="4">LAPORAN KEGIATAN BULANAN PENYULUH PERTANIAN</font></center><br>
      @php
      $penyuluh = App\Models\Penyuluh::where('user_id', Auth::user()->id)->first();
      @endphp
      <font>Nama/NIP : {{ $penyuluh->nama_penyuluh }} / {{ $penyuluh->nip }} </font>
      <table align="left">
      <td>
        <font>BPP : {{ $penyuluh->bpp->nama_bpp }}</font><br>
        <font>WKPP : {{ $data['nama_wkpp'] }}</font><br>
        <font>Bulan :{{ $data['month'] }} &ensp; {{$data['year'] }}</font><br>
      </td>
      </table>
       <br>
       <center><font>Data Laporan Kegiatan Kelompok Tani pada Dinas Pertanian Kota Padang dari {{ $data['month'] }} sampai {{ $data['year'] }}</font></center><br>
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
              @foreach($data['detail'] as $p)
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
        <br>
        <table>
          <tr>
              <td>
                  <div>
                      <div style="width:230px;float:left;margin-left:20px">
                          Mengetahui

                          @php
                          $p = App\Models\Penyuluh::where('jabatan', 'Ketua')->first();
                          @endphp
                          <br><br><br>
                          <p>{{ $p->nama_penyuluh }}<br />NIP. {{ $p->nip }}</p>
                      </div>
                      <div style="clear:both"></div>
                  </div>
              </td>
              <td> <div>
                <div style="width:230px;float:right">
                    Padang, {{ date('d F Y') }}
                    @php
                    $p = App\Models\Penyuluh::where('user_id', Auth::user()->id)->first();
                    @endphp
                    <br><br><br>
                    <p>{{ $p->nama_penyuluh }}<br />NIP. {{ $p->nip }}</p>
                </div>
                <div style="clear:both"></div>
            </div></td>
          </tr>
      </table>
    </section>
</body>
</html>

