<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Foursquare</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"  >
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"  ></script>

</head>
<body>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
		 <h3 class="title"> Foursquare  Mekan Arama</h1>
			 <input type="text" class="form-input" name="sorgu" id="sorgu">
			 <button id="ara" class="btn btn-info">Ara</button>
 			 <div id="sonuc"></div>	
	    </div>
	</div>


   
  <script type="text/javascript">
  	 $(document).ready(function(){ 

   			 $("#ara").click(function(){   
   			 	$('#sonuc').text('Lütfen Bekleyin...')
   			  var sorgu = $("#sorgu").val(); 
   			  var url = "ajax"; 
   			  $.ajax({
   			         type:"POST",
   			         url:url,           
   			         data: {sorgu: sorgu, durum: '1'},
   			         success: function(response){
   			             console.log(response);
   			            $('#sonuc').html(response)
   			         }
   			     });
   			 });
    });
  </script>
</div> 
</body>
</html>