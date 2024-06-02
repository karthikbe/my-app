
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 10 Datatables Date Range Filter</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
       
    <div class="container">
        <h1 class="text-center text-success mt-5 mb-5"><b>Product/Order Details</b></h1>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-9"><b>Order List</b></div>
                    <div class="col col-3">
                    <a class="text-light" style="color:#27292b !important" href="{{route('orders.create')}}">Create Order </a>
                    <a class="text-light" style="color:#27292b !important" href="{{route('orders.import')}}">Import Order </a>
                        <div id="daterange"  class="float-end" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; text-align:center">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> 
                            <i class="fa fa-caret-down"></i>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="daterange_table">
                    <thead>
                        <tr>
                            <th>Product No</th>
                            <th>Product Name</th>
                            <th>Product Count</th>
                            <th>Email</th>
                            <th>Created On</th>
                            <th>Action</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">



$(function () {

    var start_date = moment().subtract(1, 'M');

    var end_date = moment();

    $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));

    $('#daterange').daterangepicker({
        startDate : start_date,
        endDate : end_date
    }, function(start_date, end_date){
        $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));

        table.draw();
    });

    var table = $('#daterange_table').DataTable({
        processing : true,
        serverSide : true,
        ajax : {
            url : "{{ route('orders.index') }}",
            data : function(data){
                data.from_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                data.to_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }
        },
        columns : [
            {data : 'id', name : 'id'},
            {data : 'p_name', name : 'p_name'},
            {data : 'order_count', name : 'order_count'},
            {data : 'email', name : 'email'},
            {data : 'order_date', name : 'order_date'},
            {data : 'link', name : 'link'},
           
        ]
    });

    $(".delete-order-btn").click(function(event) {
        event.preventDefault(); 
        var orderId = $(event).attr("id");
        alert(orderId);
         // Confirmation dialog for user safety
        //  if (confirm("Are you sure you want to delete order #" + orderId + "?")) {
        //     $.ajax({
        //         url: "{{ route('orders.delete', 'orderId') }}", // Dynamic route URL generation
        //         method: 'DELETE', // Specify DELETE method for destruction
        //         data: { _token: '{{ csrf_token() }}' }, // Include CSRF token for security
        //         success: function(response) {
        //             // Handle successful deletion (e.g., remove button/row from UI)
        //             if (response.success) {
        //                 $(event.target).closest('.order-row').remove(); // Remove the order row
        //             } else {
        //                 alert('Error: ' + response.message); // Display error message (optional)
        //             }
        //         },
        //         error: function(error) {
        //             console.error('Error deleting order:', error); // Log errors to console
        //             alert('An error occurred. Please try again later.'); // User-friendly error message
        //         }
        //     });
       // }
    });

    

    

});



</script>
</html>