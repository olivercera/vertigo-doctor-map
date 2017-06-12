<?php
	require 'config.php';
?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"-->
 <link rel="stylesheet" href="<?php echo siteUrl;?>css/styles.css">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 <script type="text/javascript">
    	var url = "<?php echo siteUrl;?>";
 </script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFPVFb-q5MTsanIOvVI-oBOpo8SPn7Goo&libraries=places">
	</script>
 <script src="<?php echo siteUrl;?>js/map.js"></script>

<div class="row" style="position:relative">
  	<div  class="search-box">
      <label>Search Your Location</label> 
    	<form class="row">

    	  <div class="form-group col-sm-3">
    	    <input  id="input_MapLocation_search"  class="form-control" placeholder="Search Keywords">
    	  </div>
    	  <div class="form-group col-sm-3">
          <select class="form-control" id="providerLevel" placeholder="Provider Level">
            <option value="">Provider Level</option>
            <option value="1">Level 1</option>
            <option value="2">Level 2</option>
            <option value="3">Level 3</option>
          </select>
    	  </div>
        <div class="form-group col-sm-4">
          <label id="labelRadius"style="margin:0">Radius: 0km</label>
          <input  type="range" id="radius"  min="0" max="100" value="0" class="">
        </div>
    	  <button type="button" id="find" class="btn btn-primary col-sm-2"><span class="glyphicon glyphicon-search"></span>&nbsp;Search</button>
    	  <!--button type="button" id="clear" class="btn btn-link col-xs-1">Clear</button-->
    	</form>
  </div>
  <div class="col-xs-12">
  	<div id="map-canvas" style="width:100%px;height:300px" >
	</div>
  </div>
</div>