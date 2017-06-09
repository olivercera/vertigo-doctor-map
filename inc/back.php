<?php
	require 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vertigo Maps</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    
	<script type="text/javascript">
    	var url = "<?php echo siteUrl;?>";
    </script>
    <script src="<?php echo siteUrl;?>js/item-ajax.js"></script>
    <style type="text/css">
    	.modal-dialog, .modal-content{
		z-index:1051;
		}
    </style>
</head>
<body>

	<div class="container-fluid">
		<div class="row">
		    <div class="col-lg-12 margin-tb">					
		        <div class="pull-left">
		            <h2>Vertigo Maps</h2>
		        </div>
		        <div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
					  Create Item
				</button>
		        </div>
		    </div>
		</div>

		<div class="panel panel-primary">
			  <div class="panel-heading">Management</div>
			  <div class="panel-body">
				<table class="table table-bordered">
					<thead>
					    <tr class="">
						<th class="col-xs-1">Id</th>
						<th class="col-xs-3">Address</th>
						<th class="col-xs-1">Lat</th>
						<th class="col-xs-1">Long</th>
						<th class="col-xs-3">Action</th>
					    </tr>
					</thead>
					<tbody>
					</tbody>
				</table>

		<ul id="pagination" class="pagination-sm"></ul>
			  </div>
	  </div>

	    <!-- Create Item Modal -->
		<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Create Item</h4>
		      </div>

		      <div class="modal-body">
		      		<form data-toggle="validator" action="api/create.php" method="POST">

		      			<div class="form-group">
							<label class="control-label" for="address">Address:</label>
							<input type="text" name="address" class="form-control" data-error="Please enter address." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="lat">Lat:</label>
							<textarea name="lat" class="form-control" data-error="Please enter lat." required></textarea>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label class="control-label" for="long">Long:</label>
							<textarea name="long" class="form-control" data-error="Please enter long." required></textarea>
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn crud-submit btn-success">Submit</button>
						</div>

		      		</form>

		      </div>
		    </div>

		  </div>
		</div>

		<!-- Edit Item Modal -->
		<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
		      </div>

		      <div class="modal-body">
		      		<form data-toggle="validator" action="api/update.php" method="put">
		      			<input type="hidden" name="id" class="edit-id">

		      			<div class="form-group">
							<label class="control-label" for="address">Address:</label>
							<input type="text" name="address" class="form-control" data-error="Please enter address." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="lat">Lat:</label>
							<textarea name="lat" class="form-control" data-error="Please enter lat." required></textarea>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label class="control-label" for="long">Long:</label>
							<textarea name="long" class="form-control" data-error="Please enter long." required></textarea>
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
						</div>

		      		</form>

		      </div>
		    </div>
		  </div>
		</div>
		<div class="modal fade" id="view-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">View Item</h4>
		      </div>

		      <div class="modal-body">      		
      			<div class="form-group">
					<label class="control-label" for="address">Address:</label>
					<input type="text" name="address" class="form-control" data-error="Please enter address." disabled />
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group">
					<label class="control-label" for="lat">Lat:</label>
					<textarea name="lat" class="form-control" data-error="Please enter lat." disabled></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label class="control-label" for="long">Long:</label>
					<textarea name="long" class="form-control" data-error="Please enter long." disabled></textarea>
					<div class="help-block with-errors"></div>
				</div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</body>
</html>