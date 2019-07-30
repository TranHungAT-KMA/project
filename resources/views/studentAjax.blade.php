<!DOCTYPE html>
<html>
<head>
    <title>Tran Ba Hung CRUD Ajax</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    
<div class="container">
    <h1>Project Student Ajax CRUD</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewStudent"> Create New Student</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Ten Hoc Sinh</th>
                <th>So Dien Thoai</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="studentForm" name="studentForm" class="form-horizontal">
                   <input type="hidden" name="student_id" id="student_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Ten Hoc Sinh</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="tenhocsinh" name="tenhocsinh" placeholder="Enter tenhocsinh" value="" maxlength="50" required="">
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">SO Dien thoai</label>
                        <div class="col-sm-12">
                            <textarea id="sodienthoai" name="sodienthoai" required="" placeholder="Enter sodienthoai" class="form-control"></textarea>
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
</body>
    
<script type="text/javascript">
  $(function () {
     
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('students.index') }}",
        columns: [
            {data: 'DT_RowIndex', nam: 'DT_RowIndex'},
            {data: 'tenhocsinh', name: 'tenhocsinh'},
            {data: 'sodienthoai', name: 'sodienthoai'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
    $('#createNewStudent').click(function () {
        $('#saveBtn').val("create-Student");
        $('#student_id').val('');
        $('#studentForm').trigger("reset");
        $('#modelHeading').html("Create New Student");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editStudent', function () {
      var Student_id = $(this).data('id');
      $.get("{{ route('students.index') }}" +'/' + student_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Student");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#student_id').val(data.id);
          $('#tenhocsinh').val(data.tenhocsinh);
          $('#sodienthoai').val(data.sodienthoai);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#studentForm').serialize(),
          url: "{{ route('students.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#studentForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteStudent', function () {
     
        var Student_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('students.store') }}"+'/'+Student_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
     
  });
</script>
</html>