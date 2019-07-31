<html>
<head>
    <title>Display Datatable</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>       
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <br />
    <h3 align="center">Review Rating !</h3>
    <br />
  

     <!-- <a class="btn btn-success" href="{{url('student/edit')}}" id="createNewProduct"> Edit Data</a>
      <br>  
       <br> -->
<table id="student_table" class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                 <th>Branch Name</th>
                 <th>User Name</th>
                <th>Star</th>
                <th>Comments</th>
                <th>Action</th>
              </tr>
        </thead>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function() {

     $('#student_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('review-rating/data') !!}',
        columns:[
            { data: 'id' },
            { data: 'branch_name_en'},
            { data: 'first_name_en'},
            { data: 'star'},
            { data: 'comments'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        
     });
});
</script>
</body>
</html>
