<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Whois System</title>
    <base href="<?php echo $SCHEME.'://'.$HOST.$BASE.'/'; ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="<?php echo $UI; ?>extend.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">
      <div class="header text-center clearfix">
        <h3 class="text-muted">BiDom Whois System</h3>
      </div>

      <div class="jumbotron text-center">
        <h1>Domain Whois</h1>
        <p class="lead">You can check ~1500 tlds' whois info</p>
     <div>
      <div class="input-group">
      <input type="text" class="form-control input-lg" id="whoisWr" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default btn-lg" type="button" id="checkWhois"><span class="glyphicon glyphicon-search"></span> Whois Lookup!</button>
      </span>
      </div><!-- /input-group -->
	  <h2 class="text-center">or</h2>
      <div class="form-group">
      <textarea type="text" class="form-control input-lg" id="bulkwhoisWr" placeholder="Search for domains..." rows="10"></textarea>
	  </div>
      <div class="form-group">
      <button class="btn btn-default btn-block btn-lg" type="button" id="checkbulkWhois"><span class="glyphicon glyphicon-search"></span> Bulk Whois Lookup!</button>
	  </div>

	  
    </div>
      </div>

      <div class="row marketing" id="whoisdata" style="display:none;">
        <div class="col-md-12"><div class="well well-sm" id="winn"></div></div>
      </div>

      <div class="row marketing" id="bulkwhoisdata" style="display:none;">
        <div class="col-md-12"><table class="table table-responsive table-hover" id="bulkwinn"><tbody></tbody></table></div>
      </div>
      <div class="row marketing">
        <div class="col-md-12"><div class="well well-sm"><strong>Supported TLD'S:</strong> <?php echo implode(', ', $supported); ?></div></div>
      </div>

      <footer class="footer text-center">
        <p><a href="http://bidom.ir">BiDom</a> thanks to <a href="http://doyosi.com">Doyosi</a> &copy; 2018</p>
      </footer>

    </div> <!-- /container -->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="<?php echo $UI; ?>ajax.js"></script>
    <script>
    $(document).ready(function(){
        $("#checkWhois").on("click",function(){
        $("#whoisdata").hide();
        $this = $(this);
        $this.prop("disabled", true);
        var domain = $("#whoisWr").val();
        $.post("<?php echo $BASE; ?>/whois", {domain:domain}, function(data, textStatus) {

        if(data.status=="success") {
        $("#winn").html(data.data);
        $("#whoisdata").show();
        $this.prop("disabled", false); 
        }
        else if(data.status=="error") {
        alert(data.data);
        $this.prop("disabled", false);
        } else {
        alert("Server Alert! Please contact admin");
        $this.prop("disabled", false);
        }
        }, "json");

        });
		ajaxManager.run(); 
        $("#checkbulkWhois").on("click",function(){
        $("#whoisdata").hide();
        $("#bulkwhoisdata").hide();
        $this = $(this);
        $this.prop("disabled", true);
        var domain = $("#bulkwhoisWr").val();
        $.post("<?php echo $BASE; ?>/bulkwhois", {domain:domain}, function(data, textStatus) {

        if(data.status=="success") {
		$('#bulkwinn tbody').html("");
		var defdomains = data.data;
		$.each(defdomains, function(i, dom) {
		ajaxManager.addReq({
				   type: 'POST',
				   url: '<?php echo $BASE; ?>/whois',
				   data: {domain:dom },
				   success: function(data){
				   if(data.status=="success") {
					$('#bulkwinn tbody').append('<tr><td><h2>'+ dom+ '</h2></td></tr><tr><td>'+data.data+'</td></tr>');	
					} else {
					$('#bulkwinn tbody').append('<tr><td><h2>'+ dom+ '</h2></td></tr><tr><td>Can not get whois info for '+dom+'</td></tr>');	
					}
				   }
		});		
		
		

		});		
        $("#bulkwhoisdata").show();
        $this.prop("disabled", false); 
        }
        else if(data.status=="error") {
        alert(data.data);
        $this.prop("disabled", false);
        } else {
        alert("Server Alert! Please contact admin");
        $this.prop("disabled", false);
        }
        }, "json");

        });
    });
    </script>
  </body>
</html>