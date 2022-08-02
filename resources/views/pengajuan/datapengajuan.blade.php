@extends('layouts.backend.app')
@section('title', 'Data Pengajuan Bantuan')
@push('css')
<!-- DataTables -->
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content_title', 'Data Pengajuan Bantuan')
@section('content')
<x-alert></x-alert>
<div class="row">
    <div class="col-12">
        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelompok Tani</th>
                            <th>Tanggal Pengajuan</th>
                            <th>File</th>
                            <th>Status</th>
                            <th>Ket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $p->kelompoktani->nama_kelompoktani }}</td>
                            <td>{{ $p->created_at }}</td>
                            <td><a href="{{ asset('app/public/proposal/'.$p->proposal) }}"
                                    stream="">{{ $p->proposal }}</a></td>
                            <td>
                                @if ($p->status == 0)
                                <span class="float badge bg-info">Belum Diverifikasi</span>
                                @elseif ($p->status == 1)
                                <span class="float badge bg-primary">Diverifikasi</span>
                                @elseif ($p->status == 2)
                                <span class="float badge bg-success">Diterima</span>
                                @elseif ($p->status == 3)
                                <span class="float badge bg-danger">Ditolak</span>
                                @endif
                                <button type="button" onclick="editStatus({{ $p->id }})" id="editStatus"
                                    class="btn btn-sm " data-toggle="modal" data-target="#UpdateModal"><i
                                        class="fa fa-ellipsis-h"></i></button>
                            </td>
                            <td>{{ $p->keterangan_status }}</td>
                            <td>
                                <form action="{{ route('pengajuan.hapus', $p->id) }}" method="POST"
                                    style="display: inline">

                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

            <div class="modal fade" id="UpdateModal" role="dialog" arialabelledby="modalLabel" area-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Update Status Pengajuan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('pengajuan.status') }}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="alert alert-danger print-error-msg" style="display: none;">
                                    <ul></ul>
                                </div>
                                <div class="form-group">
                                    <select required="" name="status" id="status_edit" class="form-control" onchange="alasan()" >
                                        <option value="0">Belum Diverifikasi</option>
                                        <option value="1">Diverifikasi</option>
                                        <option value="2">Diterima</option>
                                        <option value="3">Ditolak </option>
                                    </select>
                                    <input type="hidden" name="id" id="id">
                                </div>
                                <div class="form-group" id="alasan" style="display:none">
                                  <label >Alasan Ditolak</label>
                                  <input type="text" name="keterangan_status"
                                      class="form-control">
                              </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save fa-fw"></i> SIMPAN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
</script>
<script
    src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js">
</script>
<script
    src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
</script>
<script>
    function alasan(){
        console.log($('#status_edit').val());
        var val = $('#status_edit').val();
        if(val == 3){
            $('#alasan').show();
        }else{
            $('#alasan').hide();
        }
    }

    function editStatus(id) {
        $('#id').val(id).change();
    }

    $(function () {
        $("#dataTable1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
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

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#submit', function (event) {
            event.preventDefault()
            var status = $("#status").val();

            $.ajax({
                url: 'admin/' + id,
                type: "POST",
                data: {
                    id: id,
                    name: name,
                },
                dataType: 'json',
                success: function (data) {

                    $('#updateStatus').trigger("reset");
                    $('#UpdateModal').modal('hide');
                    window.location.reload(true);
                }
            });
        });

        $('body').on('click', '#UpdateStatus', function (event) {

            event.preventDefault();
            var id = $(this).data('id');
            console.log(id)
            $.get('color/' + id + '/edit', function (data) {
                $('#userCrudModal').html("Edit category");
                $('#submit').val("Edit category");
                $('#UpdateModal').modal('show');
                $('#status').val(data.data.status);
            })
        });

    });

</script>
@endpush
