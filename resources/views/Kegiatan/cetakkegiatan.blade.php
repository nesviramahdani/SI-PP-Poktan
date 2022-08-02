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
        @page {
            size: A4
        }

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
            border: 1px solid #000000;
            text-align: center;
        }

        .table td {
            padding: 3px 3px;
            border: 1px solid #000000;
        }

        .text-center {
            text-align: center;
        }

        .row {
            display: flex;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

    </style>
</head>

<body class="A4">
    <section class="sheet padding-10mm">
        <br>
        <center>
            <font size="4">RENCANA KEGIATAN/KUNJUNGAN BULANAN PENYULUH PERTANIAN</font>
        </center><br>
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
        <center>
            <font>Rencana Kegiatan Penyuluhan pada Dinas Pertanian Kota Padang dari  {{ $data['tanggal_mulai'] }} sampai
                {{ $data['tanggal_mulai'] }}</font>
        </center><br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Kegiatan</th>
                    <th scope="col">Tanggal Kegiatan</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Kelompoktani</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['cetakkegiatan'] as $p)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $p->kegiatan->nama_kegiatan }}</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($p->kegiatan->tanggal_kegiatan)->format('l/d/m/Y')}}</td>
                    <td class="text-center">{{ $p->kegiatan->jam_mulai }}-{{ $p->kegiatan->jam_selesai }}</td>
                    <td>{{ $p->kegiatan->lokasi }}</td>
                    <td>{{ $p->kelompoktani->nama_kelompoktani }}</td>
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
                            Padang, {{ date('d F Y') }}
                            @php
                            $p = App\Models\Penyuluh::where('id', Auth::user()->id)->first();
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
