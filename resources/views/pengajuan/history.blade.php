@extends('layouts.backend.app')
@section('title', 'History Pengajuan')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Sweetalert 2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.css">
@endpush
@section('content_title', 'History Pengajuan')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <table id="dataTable2" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Pengajuan</th>
            <th>File</th>
            <th>Keterangan</th>
            <th>Status</th>

          </tr>
          </thead>
          @php
          $no=1;
          @endphp
          <tbody>
              @foreach($pengajuan as $row)
              <tr>
                  <th scope="row">{{ $no++ }}</th>
                  <td>{{ $row->created_at }}</td>
                  <td><a href="{{ asset('app/public/proposal/'.$row->proposal) }}" stream="">{{ $row->proposal }}</a></td>
                  <td>{{ $row->keterangan }}</td>
                  <td>
                    @if ($row->status == 0)
                    <span class="float badge bg-info">Belum Diverifikasi</span>
                    
                      <form action="{{ route('pengajuan.destroy', $row->id) }}" method="POST" style="display: inline">
      
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-trash"></i> </button>
                      </form>
                    
                    @elseif ($row->status == 1)
                    <span class="float badge bg-primary">Diverifikasi</span>
                    @elseif ($row->status == 2)
                    <span class="float badge bg-success">Diterima</span>
                    @elseif ($row->status == 3)
                    <span class="float badge bg-danger">Ditolak</span>
                    @endif
                  </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@stop
@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $(function () {
    $('#dataTable2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  }); 
  
</script>
@endpush