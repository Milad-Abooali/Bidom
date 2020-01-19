<?php

    $domain = $_GET['d'];
    define('CDN', 'http://cdn.codebox.localhost');

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BiDom</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
      body {
        padding-top: 54px;
      }
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      }
    </style>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">BiDom</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <div  class="col-lg-12">
                <input id="domainq" dir="ltr" class="form-control text-center" name="domain" placeholder="example" size="16" type="text">
            </div>
            <div  class="col-lg-12">
              <br>
              <button id="isfree" class="btn btn-success" type="submit"> Is Free <i class="fa fa-arrow-circle-left mr-2"></i></button>
              <button id="whois" class="btn btn-success" type="submit"> Whois <i class="fa fa-arrow-circle-left mr-2"></i></button>
              <button id="dns" class="btn btn-success" type="submit"> DNS Check <i class="fa fa-arrow-circle-left mr-2"></i></button>
              <br><br>
            </div>
        </div>
    </div>

      <div class="row">
        <div id="outw" class="col-lg-12 text-center">
            
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){

    $('body').on('click','#whois',function(){
        var domain = $("#domainq").val();
        $.post("engin/whois", {domain:domain}, function(data) {
            if(data.status=="success") {
                 $("#outw").html('<div class="col-lg-12 text-left">'+data.data+'</div>');
            }
            else if(data.status=="error") {
                 $("#outw").html('<div class="col-lg-12 text-left">'+data.data+'</div>');
            } else {
                alert("Server Alert! Please contact admin");
                $("#outw").html('<div class="card col-lg-12 text-left">'+data.data+'</div>');
            }
        }, "json");
    });

    $('body').on('click','#isfree',function(){
        var domain = $("#domainq").val();
        $.post("free.php", 'd='+domain, function(data) {
            if (data==1) {
                $("#outw").html('<div class="col-lg-12"><img src="/static/images/error.gif" alt="Not free"> Registerd ! </div>');
            } else {
                $("#outw").html('<div class="col-lg-12"><img src="/static/images/pass.gif" alt="free"> Free To register.</div>');
            }
        });
    });

    $('body').on('click','#dns',function(){
        $("#outw").html('<img id="loading-image" src="/static/images/loading-image.gif" />');
        var domain = $("#domainq").val();
        $.post("dns.php", 'd='+domain, function(data) {
            $("#outw").html(data);
        });
    });
    
});

</script>

  </body>

</html>
