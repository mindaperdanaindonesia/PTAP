<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PTAP</title>
<style type="text/css">
    

</style>
    <!-- Bootstrap -->

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/template/style.css" type="text/css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
       <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   <div class="container-fluid" >
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row" style="background-color: transparent; !important; margin-top: 50px;">
<div class="col-md-2"></div>
<div class="col-md-4"> 
    <div id="gambarlogin"><img src="<?php echo base_url();?>assets/images/template/pasted%20svg%20485247x524_poster_.png" class="img-responsive" ></div>
</div>
<div class="col-sm-4">
    <div class="headlogin"><div style="width: 50px;height:50px; float: left;background-color: #7F7F7F; margin:10px 0px 10px 10px;"></div>
    <div style="width: 145px;height:40px; float: left; margin:10px;font-size: 12px;color: white;padding: 10px;">MINDA HIGH SCHOOL</div></div>

    <div class="formlogin">
    <div class="boxformlogin">ptap</div>
    <form id="login" action="<?php echo base_url();?>auth/login" method="post" />

        <div class="form-group">
        <div class="inputwrapper">
                <input type="text"name="username" id="username" placeholder="Enter Your Email" class="inputlogin"/>
        </div>
    <div class="inputwrapper">
                <input type="password" name="password" id="password" placeholder="Enter Your password" class="inputlogin"/>
        </div>
        </div>
        <div style="margin-left: 135px">

<div class="inputwrapper">
                <button name="submit" class="buttonlogin">LOGIN</button>
</div></div>
</form>

    </div>
</div>
<div class="col-md-2"></div>
</div>

<div class="row" style="background-color: transparent; !important;">
<div class="col-md-3"></div>
<div class="col-md-3"> 
<div class="titlelogin">
<p> parent 
    teacher as 
    partner</p> 
   
    </div>
</div>
<div class="col-md-3">
   
</div>
<div class="col-md-3"></div>
</div>
<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->

</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   
  </body>
</html>
