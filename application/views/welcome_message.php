<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- yahan se data_table and jquery ki link hai -->
    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.min.css">

    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <div class="container">
        <button id="add_button" class="btn btn-primary" style="width:100%;">+Add</button>
        <div class="table-responsive">
            <br />
            <table id="practice" class="table table-bordered table-striped">
                <thead>
                    <tr>



                        <th width="20%">title</th>
                        <th width="30%">image</th>
                        <th width="10%">languages</th>
                        <th width="10%">status</th>
                        <th width="10%">view</th>
                        <th width="10%">update</th>
                        <th width="10%">delete</th>











                        <!-- <th width="35%">Pasword</th>   -->

                    </tr>
                </thead>
            </table>
        </div>

        <!-- modal for the add -->
        <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addform" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Title</label>
                                    <input name="title" id="title" class="form-control">

                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>image</label>
                                    <input type="file" name="image" id="image" class="form-control">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>languages</label>
                                    <input name="languages" id="languages" class="form-control">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Status</label>
                                    <input name="status" id="status" class="form-control">

                                </div>

                            </div>
                        </form>
                        <button id="submitadd" class="btn btn-success mt-3  " style="width:100%;">Submit</button>





                    </div>




                </div>



            </div>
        </div>


        <!-- modal for the update -->
        <div class="modal fade" id="updatemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formupdate">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Title</label>
                                    <input name="titleupdate" id="titleupdate" class="form-control">

                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>image</label>
                                    <input type="file" name="imageupdate" id="imageupdate" class="form-control">
                                    <span id="image_preview">

                                    </span>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>languages</label>
                                        <input name="languagesupdate" id="languagesupdate" class="form-control">

                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Status</label>
                                        <input name="statusupdate" id="statusupdate" class="form-control">

                                    </div>



                                </div>


                            </div>
                        </form>
                        <button id="updatesubmit" class="btn btn-primary mt-3 " style="width:100%">Submit</button>


                    </div>
                </div>
            </div>





        </div>



    </div>
    <input id="hidden" type="hidden" value=""  />
    <script>
        $("#practice").DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                url: "<?php echo base_url("Welcome/table")   ?>",
                type: "POST",

            },
            "columnDefs": [{

                "orderable": false,
                "targets": [],


            }, ],


        })
        $("#add_button").on("click", function() {
            console.log("rohit");
            $("#addmodal").modal("show");
            var formdata = new FormData($("#addform")[0]);//for using this type of the formdata remeber in form enctype is added and also processData is false and contentTYpe is false




        });

        // while sending the add data to the database
        $("#submitadd").on("click", function() {
            $("#addmodal").modal("hide");
            var formdata = new FormData($("#addform")[0]);
            $.ajax({
                url: "<?php echo base_url("Crud_controller/send_add_data") ?>",
                method: "post",

                data: formdata,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data) {
                    alert(data);
                   



                }







            })






        })

        //click on the update button
        $(document).on("click", ".update", function() {
            const id = $(this).attr("id");
            $("#hidden").val(id);
            $("#updatemodal").modal("show");
            $.ajax({
                url: "<?php echo base_url("Crud_controller/fetch_update_data") ?>",
                method: "post",
                dataType: 'json',
                data: {
                    id: id,
                },
                success: function(data) {
                    console.log(data);
                    $("#titleupdate").val(data[0].title);
                    $("#image_preview").html(data[0].image);
                    $("#languagesupdate").val(data[0].language);
                    $("#statusupdate").val(data[0].status);
                  



                }










            })




        })
        $("#updatesubmit").on("click",function(){
            var formData = new FormData($("#formupdate")[0]);
            id=$("#hidden").val();
            console.log(id);

              $.ajax({
                url:"<?php echo base_url("Crud_controller/send_update_data") ?>",
                method:"post",
                dataType:"json",
                success:function(data){
                    

                }
  




            })




           


         




        })
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

</body>

</html>