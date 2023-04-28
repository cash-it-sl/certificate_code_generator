<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title> Certificate Code Generator</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>

<body>

    <div>
       


    </div>
    <div>
        <form action="codegenerator.php" method="post">
             <div class="container">
                <div class="row">
                        <div class="col-sm-3">
                            <h1> Certificate Code Generator </h1>
                            <p> Fill the form with correct values </p>
                            <hr class="mb-3">
                            <label for="fullname"><b>Full Name</b></label>
                            <input class="form-control" type="text" name="fullname" id="fullname" required>

                            <label for="nic"><b>NIC</b></label>
                            <input class="form-control" type="text" name="nic" id="nic" required>

                            <label for="event"><b>EventID</b></label>
                            <input class="form-control" type="text" name="event" id="event" required>

                            <label for="event"><b>Term</b></label>
                            <input class="form-control" type="text" name="term" id="term" placeholder="xx"required>

                            <label for="date"><b>Date of Issue</b></label>
                            <input class="form-control" type="date" name="date" id="date"required>

                            <label for="certificatedis"><b>Certificate Description</b></label>
                            <input class="form-control" type="text" name="certificatedis" id="certificatedis" required>

                            <label for="event"><b>Cat ID</b></label>
                            <input class="form-control" type="text" name="catid" id="catid" required>
                            
                            <label for="type"><b>Degree Type</b></label>
                            <select class="form-select" aria-label="Default select example" name="type" id="type">
                                <option selected>CT</option>
                                <option value="1">ET</option>
                                <option value="2">CS</option>
                                <option value="3">Other</option>
                            </select>
                        
                            
                            <hr class="mb-3">
                            <input class="btn btn-primary" type="submit" name="generate" id="reg" value="generate">
                             
                            <input class="btn btn-dark" type="reset" name="clear" id="reg" value="clear">
                        </div>    

                    </div>  
                </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">

        $(function(){
            $('#reg').click(function(e){

               var valid = this.form.checkValidity();

              

               if(valid){
               

               var fullname        = $('#fullname').val();
               var nic             = $('#nic').val();
               var event           = $('#event').val();
               var date            = $('#date').val();
               var certificatedis = $('#certificatedis').val();
               var type            = $('#type').val();
               var term          = $('#term').val();  
               var catid         =$('#catid').val();  
               
               e.preventDefault();

                $.ajax({
                    type : 'POST',
                    url : 'process.php',
                    data : {fullname : fullname, nic : nic, event : event, date :date, certificatedis:certificatedis , type:type , term:term ,catid:catid},
                    success: function(data){
                        Swal.fire({
                        'title':'Code Generated',
                        'text' : data,
                         'icon' : 'success'
                        });
                    
                   // Send data to QR_component.php
                   $.ajax({
                        type: 'POST',
                        url: 'QR_component.php',
                        data: { data: data },
                        success: function(response) {
                           // Create a hidden link element and click on it to download the response PNG
                         var link = document.createElement('a');
                         link.href = 'data:image/png;base64,' + response;
                        link.download = 'qr-code.png';
                        link.style.display = 'none';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);    
                        },
                        error: function(response) {
                            console.log(response);
                            console.log('Error downloading QR code: ' + textStatus + ', ' + errorThrown);
        console.log(jqXHR);
                        }
                    });

                    },
                    error:function(data){
                        Swal.fire({
                          'title':'Error',
                          'text' : data,
                          'icon' : 'error'
                           })
                    }
                });    

                
               }else{
               } 
             


            });
           
        });

    </script>   
</body>
</html>