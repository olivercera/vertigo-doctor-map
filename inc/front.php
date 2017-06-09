<?php
	require 'config.php';
?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 <script type="text/javascript">
    	var url = "<?php echo siteUrl;?>";
 </script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFPVFb-q5MTsanIOvVI-oBOpo8SPn7Goo&libraries=places">
	</script>
 <script src="<?php echo siteUrl;?>js/map.js"></script>
<style>
#input_MapLocation_search{
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 95%;
	margin-top: 20px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}
#input_MapLocation_search:focus{
	border-color: #4d90fe;	
} 
</style>
<div class="row">
  	<div  class="col-xs-12">
	<form class="row">
	  <div class="form-group col-xs-3">
	    <input type="firstName" id="firstName" class="form-control" placeholder="First Name">
	  </div>
	  <div class="form-group col-xs-3">
	    <input type="lastName" id="lastName" class="form-control" placeholder="Last Name">
	  </div>
	  <button type="button" id="find" class="btn btn-default col-xs-1">Find</button>
	  <button type="button" id="clear" class="btn btn-link col-xs-1">Clear</a>
	</form>
  </div>
  <div class="col-xs-12">
  	<div id="map-canvas" style="width:100%px;height:300px" >
	</div>
  </div>
</div>