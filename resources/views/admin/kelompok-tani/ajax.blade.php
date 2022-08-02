<script>
$(function () {
  
  var table = $("#dataTable2").DataTable({
      processing: true,
      serverSide: true,
      "responsive": true,
      ajax: "{{ route('kelompok-tani.index') }}",
      columns: [
          {data: 'DT_RowIndex' , name: 'id'},
          {data: 'id_kelompoktani', name: 'id_kelompoktani'},
          {data: 'nama_kelompoktani', name: 'nama_kelompoktani'},
          {data: 'kelas_kelompok', name: 'kelas_kelompok'},
          {data: 'badan_hukum', name: 'badan_hukum'},
          {data: 'alamat_sekretariat', name: 'alamat_sekretariat'},
          {data: 'wkpp.penyuluh.nama_penyuluh', name: 'wkpp.penyuluh.nama_penyuluh'},
          {data: 'action', name: 'action', orderable: false, searchable: true},
      ]
  });

});

// Reset Form
  function resetForm(){
      $("[name='id_kelompoktani']").val("")
      $("[name='nama_kelompoktani']").val("")
      $("[name='jumlah_anggota']").val("")
      $("[name='luas_lahan']").val("")
  }

// create
$("#store").on("submit", function(e) {
  e.preventDefault()
  $.ajax({
    url: "{{ route('kelompok-tani.store') }}",
    method: "POST",
    data: $(this).serialize(),
    success:function(response) {
      if ($.isEmptyObject(response.error)) {
        $("#createModal").modal("hide")
        $('#dataTable2').DataTable().ajax.reload()
        Swal.fire(
          '',
          response.message,
          'success'
        )
        resetForm()
      }else{
        printErrorMsg(response.error)
      }
    },
    error: function(err) {
      if (err.status == 403) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Not allowed!'
        })
      }
    }
  });
})

// create-error-validation
function printErrorMsg(msg) {
  $(".print-error-msg").find("ul").html('');
  $(".print-error-msg").css('display', 'block');
  $.each(msg, function(key, value) {
    $(".print-error-msg").find("ul").append('<li>'+value+'</li>')
  });
}

// edit
$("body").on("click", ".btn-edit", function() {
  var id = $(this).attr("id")
  $.ajax({
    url: "/admin/kelompok-tani/"+id+"/edit",
    method: "GET",
    success: function(response) {
      $("#id_edit").val(response.data.id)
      $("#id_kelompoktani_edit").val(response.data.id_kelompoktani)
      $("#nama_kelompoktani_edit").val(response.data.nama_kelompoktani)
      $("#tanggal_terbentuk_edit").val(response.data.tanggal_terbentuk)
      $("#kelas_kelompok_edit").val(response.data.kelas_kelompok)
      $("#badan_hukum_edit").val(response.data.badan_hukum)
      $("#alamat_sekretariat_edit").val(response.data.alamat_sekretariat)
      $("#wkpp_id_edit").val(response.data.wkpp_id)
      $("#editModal").modal("show")
    },
    error: function(err) {
      if (err.status == 403) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Not allowed!'
        })
      }
    }
  })
})

// update
$("#update").on("submit", function(e) {
  e.preventDefault()
  var id = $("#id_edit").val()
  $.ajax({
    url: "/admin/kelompok-tani/"+id,
    method: "PATCH",
    data: $(this).serialize(),
    success: function(response) {
      if ($.isEmptyObject(response.error)) {
        $("#editModal").modal("hide")
        $('#dataTable2').DataTable().ajax.reload()
        Swal.fire(
          '',
          response.message,
          'success'
        )
      }else{
        printErrorMsg(response.error)
      }
    },
    error: function(err) {
      if (err.status == 403) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Not allowed!'
        })
      }
    }
  })
})

// delete
$("body").on("click", ".btn-delete", function() {
  var id = $(this).attr("id")

  Swal.fire({
    title: 'Yakin hapus data ini?',
    // text: "You won't be able to revert",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/admin/kelompok-tani/"+id,
        method: "DELETE",
        success: function(response) {
          $('#dataTable2').DataTable().ajax.reload()
          Swal.fire(
            '',
            response.message,
            'success'
          )
        },
        error: function(err) {
          if (err.status == 403) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Not allowed!'
            })
          }
        }
      })
    }
  })
})
</script>