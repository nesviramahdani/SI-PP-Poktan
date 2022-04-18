<script>
$(function () {
  var table = $("#dataTable2").DataTable({
      processing: true,
      serverSide: true,
      "responsive": true,
      ajax: "{{ route('admin.index') }}",
      columns: [
          {data: 'DT_RowIndex' , name: 'id'},
          {data: 'nama_admin', name: 'nama_admin'},
          {data: 'username', name: 'username'},
          {data: 'action', name: 'action', orderable: false, searchable: true},
      ]
  });
});


  // Reset Form
  function resetForm(){
      $("[name='nama_admin']").val("")
      $("[name='username']").val("")
  }
  
  // Create 
  $("#store").on("submit",function(e){
    e.preventDefault()
    $.ajax({
        url: "{{ route('admin.store') }}",
        method: "POST",
        data: $(this).serialize(),
        success:function(response){
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
        }
    })
  })
  
  // create-error-validation
  function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $.each(msg, function(key, value) {
      $(".print-error-msg").find("ul").append('<li>'+value+'</li>')
    });
  }
  
  // Edit 
  $('body').on("click",".btn-edit",function(){
    var id = $(this).attr("id")

    $.ajax({
        url: "/admin/admin/"+id+"/edit",
        method: "GET",
        success:function(response){
            $("#editModal").modal("show")
            $("#id_edit").val(response.data.id)
            $("#nama_admin_edit").val(response.data.nama_admin)
        }
    })
  });

  // update
  $("#update").on("submit",function(e){
    e.preventDefault()
    var id = $("#id_edit").val()
    $.ajax({
        url: "/admin/admin/"+id,
        method: "PATCH",
        data: $(this).serialize(),
        success:function(response){
          if ($.isEmptyObject(response.error)) {
              $('#dataTable2').DataTable().ajax.reload();
              $("#editModal").modal("hide")
              Swal.fire(
                '',
                response.message,
                'success'
              )
          }else{
            printErrorMsg(response.error)
          }
        }
    })
  })
  
  // delete
  $('body').on("click",".btn-delete",function(){
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
          url: "/admin/admin/"+id,
          method: "DELETE",
          success: function(response) {
            $('#dataTable2').DataTable().ajax.reload()
            Swal.fire(
              '',
              response.message,
              'success'
            )
          }
        })
      }
    })
  });
</script>