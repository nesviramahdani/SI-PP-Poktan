@extends('layouts.backend.app')
@section('title', 'Dashboard')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/chart.js/Chart.min.css">
@endpush

@section('content_title', 'Dashboard')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
<!-- ./col -->
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ $total_kelompoktani }}</h3>

        <p>Kelompok Tani</p>
      </div>
      <div class="icon">
        <i class="fas fa-school"></i>
      </div>
      <a href="{{ route('kelompok-tani.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $total_anggota }}</h3>

        <p>Anggota</p>
      </div>
      <div class="icon">
        <i class="fas fa-users"></i>
      </div>
      <a href="{{ route('anggota.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ $total_penyuluh }}</h3>

        <p>Penyuluh</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-secret"></i>
      </div>
      <a href="{{ route('penyuluh.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $jumlah_produksi }}</h3>

        <p>Produksi (ton)</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-tie"></i>
      </div>
      <a href="{{ route('produksi.dataproduksi') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
 
</div>
<!-- /.row -->

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">Anggota</div>
                <div class="card-body">
                    <canvas id="canvas" height="200" width="500"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/chart.js/Chart.min.js"></script>
<script>
var ctx = document.getElementById("canvas").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Anggota Laki-laki", "Anggota Perempuan"],
      datasets: [{
        label: '',
        data: [
        {!! $anggota_laki_laki !!},
        {!! $anggota_perempuan !!},
        ],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
</script>

<script>
  var ctx = document.getElementById("canvas").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Anggota Laki-laki", "Anggota Perempuan"],
        datasets: [{
          label: '',
          data: [
          {!! $anggota_laki_laki !!},
          {!! $anggota_perempuan !!},
          ],
          backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          ],
          borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  </script>
@endpush