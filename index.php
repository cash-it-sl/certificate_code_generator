<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title> Verification Portal</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<style>
* {
    /* Change your font family */
    font-family: sans-serif;
}

.fetched-table{
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    min-width: 400px;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.fetched-table .msg{
    background-color: #009879 ;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
}
.content-table th,
.content-table td {
    padding: 12px 15px;
}

.content-table tr{
    border-bottom: 1px solid #dddddd;
    
}

.content-table tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.fetched-table .tbd tr:last-of-type {
    font-weight: bold;
    border-bottom: 2px solid #009879;
}

</style>
</head>

<body>
  <div class="header">
       <center> <h1> Certificate Verification Portal </h1> </center>
  </div>

   <div class="container">
        <div class="website">
            <h2 id="messagedisplay">  </h2>

        </div>
    <div class="formpost">
       <!-- <div class="searchpanel">
            <input type="text" class="searchbox" name="id" id="id">
            <input type="submit" class="searchbtn" name="searchdata" id="searchdata" value="SEARCH">
        </div>
        <form >-->
<center><div class="form-row align-items-center">
 <div class="col-sm-3 my-1">
<input type="text" class="form-control mb-2 mr-sm-2" name="id" id="id" placeholder="Code ID">
</div>
<div class="col-auto my-1">
<button type="submit" class="btn btn-primary mb-2" name="searchdata" id="searchdata" value="SEARCH">Submit</button>
 </div>
</form>
        <form id="vedfornid" method="post">


        </form>

    </div>
    </div>
</center>
<script>

$(document).ready(function(){
    $('#searchdata').click(function(e){
        e.preventDefault();

        var id = $('#id').val();
        
        $.ajax({
                    type : 'POST',
                    url : 'fetch_component.php',
                    data : {
                        "search_post_btn" : 1,
                        "id" : id ,
                    },
                    dataType : "text",
                    success: function(response){
                        $("#vedfornid").html(response);
                        $("#vedfornid table").addClass("fetched-table");
                        }
                    
                   
                    
                   
                });  
    });
});

</script>
</body>
</html>