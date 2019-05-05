
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">    
    <link rel="stylesheet" href="css/style.css">
    <title>Select All</title>
</head>
<body>
    
<div class="container-fluid">
    <div class="container">
        <h1 class="text-center mt-3 mb-3"> Custom    Record Selection </h1>    
        <div class="row">
            <div class="table-box-over" id="datatable">

            </div>
        </div>
    </div>

    <div class="container">
        <div class="responsive-flex-row">
            <button class="btn btn-lg btn-primary m-2" id="select_all"> Select All </button>
            <button class="btn btn-lg btn-warning m-2" id="deselect_all"> Unselect All </button>   
            <button class="btn btn-lg btn-success m-2" data-toggle="modal" data-target="#activeModalCenter"> Active </button>   
            <button class="btn btn-lg btn-danger m-2" data-toggle="modal" data-target="#deactiveModalCenter"> Deactive </button>   
        </div>
    </div>

    <!-- Active Modal -->
    <div class="modal fade" id="activeModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="activeModalCenter">Active Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            <h5>Are You Sure Want To Active ?</h5>
            <img src="image/faq.png" alt="User Icon" class="img-center">
        </div>
        <div class="modal-footer">
            <form method="post" id="active_data">
                <button type="submit" class="btn btn-success">Active</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="ac_click">Close</button>
            </form>
        </div>
        </div>
    </div>
    </div>

    <!-- Deactive Modal -->
    <div class="modal fade" id="deactiveModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deactiveModalCenter">Deactive Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            <h5>Are You Sure Want To Deactive ?</h5>
            <img src="image/faq.png" alt="User Icon" class="img-center">
        </div>
        <div class="modal-footer text-center">
            <form method="post" id="deactive_data">
                <button type="submit" class="btn btn-danger" >Deactive</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="dac_click" >Close</button>
            </form>
        </div>
        </div>
    </div>
    </div>

</div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script type="text/javascript">

    $(document).ready(function (){

        $('#datatable').load('data-record.php');

        $(document).on("click", "#select_all", function(){
            $('.check-box').prop('checked', true);
        });

        $(document).on("click", "#deselect_all", function(){
            $('.check-box').prop('checked', false);
        });

        $('#active_data').on("submit", function(e){
            e.preventDefault();
            var rec_val = [];
            $.each($("input[name='status']:checked"), function(){            
                rec_val.push($(this).data('dataid'));
            });
            var data_string = rec_val.join(",");
            if(data_string == ''){
                console.log('Please Select Record');
            }
            else{
                $.ajax({
                    type:'POST',
                    url:'ajax/ch-process.php',
                    data: { 'data_string' : data_string },
                    success: function (response){
                        var data = JSON.parse(response);
                        if(data.status == 104){
                            $('#datatable').load('data-record.php');
                            $( "#ac_click" ).trigger( "click" );
                            console.log(data.msg);
                        }
                        else{
                            console.log(data.msg);
                        }
                    }
                });
            }
        });

        $('#deactive_data').on("submit", function(e){
            e.preventDefault();
            var rec_val2 = [];
            $.each($("input[name='status']:checked"), function(){            
                rec_val2.push($(this).data('dataid'));
            });
            var de_data_string = rec_val2.join(",");
            if(de_data_string == ''){
                console.log('Please Select Record');
            }
            else{
                $.ajax({
                    type:'POST',
                    url:'ajax/ch-process.php',
                    data: { 'de_data_string' : de_data_string },
                    success: function (response){
                        var data = JSON.parse(response);
                        if(data.status == 106){
                            $('#datatable').load('data-record.php');
                            $( "#dac_click" ).trigger( "click" );
                            console.log(data.msg);
                        }
                        else{
                            console.log(data.msg);
                        }
                    }
                });
            }

        });



    });

</script>

</body>
</html>