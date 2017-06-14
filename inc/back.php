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
						<th class="col-xs-3">First Name</th>
						<th class="col-xs-1">Last Name</th>
						<th class="col-xs-1">Address</th>
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
		      			<div class="row">
			      			<div class="form-group col-xs-6" >
								<label class="control-label" for="address">Npi:</label>
								<input type="text" name="npi" class="form-control" data-error="Please enter npi." required />
								<div class="help-block with-errors"></div>
							</div>

							<div class="form-group col-xs-6">
								<label class="control-label" for="lat">Provider Level:</label>
								<input name="providerLevel" class="form-control" data-error="Please enter provider level." required></input>
								<div class="help-block with-errors"></div>
							</div>
							
						</div>
						<div class="row">
							<div class="form-group col-xs-6" >
								<label class="control-label" for="long">Provider First Name:</label>
								<input name="providerFirstName" class="form-control" data-error="Please enter provider First Name." required></input>
								<div class="help-block with-errors"></div>
							</div>
			      			<div class="form-group col-xs-6" >
								<label class="control-label" for="long">Provider Last Name:</label>
								<input name="providerLastName" class="form-control" data-error="Please enter provider Last Name." required></input>
								<div class="help-block with-errors"></div>
							</div>
							
						</div>
						<div class="row">
							<div class="form-group col-xs-6" >
								<label class="control-label" for="address">Provider Address:</label>
								<input type="text" name="providerAddress" class="form-control" data-error="Please enter provider address." required />
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-6" >
								<label class="control-label" for="long">Provider Business Phone:</label>
								<input name="providerBusinessPhone" class="form-control" data-error="Please enter provider bussines phone." required></input>
								<div class="help-block with-errors"></div>
							</div>
						</div>
							<!--div class="form-group col-xs-4" >
								<label class="control-label" for="long">Provider Middle Name:</label>
								<input name="providerMiddleName" class="form-control" data-error="Please enter provider Middle Name." required></input>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Provider Name Prefix:</label>
								<input name="providerNamePrefix" class="form-control" data-error="Please enter provider name prefeix." required></input>
								<div class="help-block with-errors"></div>
							</div>
							
						</div>
						<div class="row">
							<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Provider Name Suffix:</label>
								<input name="providerNamePrefix" class="form-control" data-error="Please enter provider Name Suffix." required></input>
								<div class="help-block with-errors"></div>
							</div>
			      			<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Provider Credential:</label>
								<input name="providerCredential" class="form-control" data-error="Please enter provider Credential." required></input>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Provider Other First Name:</label>
								<input name="providerOtherFirstName" class="form-control" data-error="Please enter provider other First Name." required></input>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row">
							
							<div class="form-group col-xs-3" >
								<label class="control-label" for="long">Provider Other Last Name:</label>
								<input name="providerOtherLastName" class="form-control" data-error="Please enter provider other Last Name." required></input>
								<div class="help-block with-errors"></div>
							</div>
			      			<div class="form-group col-xs-3" >
								<label class="control-label" for="address">Provider Address:</label>
								<input type="text" name="providerAddress" class="form-control" data-error="Please enter provider address." required />
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-3">
								<label class="control-label" for="lat">Provider Lat:</label>
								<input name="providerLat" class="form-control" data-error="Please enter lat." required></input>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-3">
								<label class="control-label" for="lat">Provider Long:</label>
								<input name="providerLong" class="form-control" data-error="Please enter long." required></input>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-xs-3" >
								<label class="control-label" for="long">Provider Business Phone:</label>
								<input name="providerBusinessPhone" class="form-control" data-error="Please enter provider bussines phone." required></input>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-3" >
								<label class="control-label" for="long">Provider Business Fax:</label>
								<input name="providerBusinessFax" class="form-control" data-error="Please enter provider bussines fax." required></input>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-3" >
								<label class="control-label" for="long">Last Updated Date:</label>
								<input name="lastUpdatedDate" class="form-control" data-error="Please enter updated date." required></input>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-3" >
								<label class="control-label" for="long">Provider Gender Code:</label>
								<input name="providerGenderCode" class="form-control" data-error="Please enter provider gender code." required></input>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Healthcare Provider Taxonomi Code:</label>
								<input name="healthcareProviderTaxonomyCode" class="form-control" data-error="Please enter Healthcare taxonomy code." required></input>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Provider License Number:</label>
								<input name="providerLicenseNumber" class="form-control" data-error="Please enter provider license number." required></input>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Provider License Number State:</label>
								<input name="providerLicenseNumberState" class="form-control" data-error="Please enter provider license number state." required></input>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Healthcare Provider C2:</label>
								<input name="healthcareProviderC2" class="form-control" data-error="Please enter Healthcare provider c2." required></input>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Healthcare Provider C3:</label>
								<input name="healthcareProviderC3" class="form-control" data-error="Please enter Healthcare provider c3." required></input>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Other Provider Identifier:</label>
								<input name="otherProviderIdentifier" class="form-control" data-error="Please enter other provider identifier." required></input>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Other Provider Code:</label>
								<input name="otherProviderCode" class="form-control" data-error="Please enter other provider code." required></input>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-4" >
								<label class="control-label" for="long">Other Provider State:</label>
								<input name="otherProviderState" class="form-control" data-error="Please enter other provider state." required></input>
								<div class="help-block with-errors"></div>
							</div>
						</div-->
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

		      			<div class="row">
			      			<div class="form-group col-xs-6" >
								<label class="control-label" for="address">Npi:</label>
								<input type="text" name="npi" class="form-control" data-error="Please enter npi." required />
								<div class="help-block with-errors"></div>
							</div>

							<div class="form-group col-xs-6">
								<label class="control-label" for="lat">Provider Level:</label>
								<input name="providerLevel" class="form-control" data-error="Please enter provider level." required></input>
								<div class="help-block with-errors"></div>
							</div>
							
						</div>
						<div class="row">
							<div class="form-group col-xs-6" >
								<label class="control-label" for="long">Provider First Name:</label>
								<input name="providerFirstName" class="form-control" data-error="Please enter provider First Name." required></input>
								<div class="help-block with-errors"></div>
							</div>
			      			<div class="form-group col-xs-6" >
								<label class="control-label" for="long">Provider Last Name:</label>
								<input name="providerLastName" class="form-control" data-error="Please enter provider Last Name." required></input>
								<div class="help-block with-errors"></div>
							</div>
							
						</div>
						<div class="row">
							<div class="form-group col-xs-6" >
								<label class="control-label" for="address">Provider Address:</label>
								<input type="text" name="providerAddress" class="form-control" data-error="Please enter provider address." required />
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-xs-6" >
								<label class="control-label" for="long">Provider Business Phone:</label>
								<input name="providerBusinessPhone" class="form-control" data-error="Please enter provider bussines phone." required></input>
								<div class="help-block with-errors"></div>
							</div>
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
      				<div class="row">
		      			<div class="form-group col-xs-6" >
							<label class="control-label" for="address">Npi:</label>
							<input type="text" name="npi" class="form-control" data-error="Please enter npi." disabled />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group col-xs-6">
							<label class="control-label" for="lat">Provider Level:</label>
							<input name="providerLevel" class="form-control" data-error="Please enter provider level." disabled></input>
							<div class="help-block with-errors"></div>
						</div>
						
					</div>
					<div class="row">
						<div class="form-group col-xs-6" >
							<label class="control-label" for="long">Provider First Name:</label>
							<input name="providerFirstName" class="form-control" data-error="Please enter provider First Name." disabled></input>
							<div class="help-block with-errors"></div>
						</div>
		      			<div class="form-group col-xs-6" >
							<label class="control-label" for="long">Provider Last Name:</label>
							<input name="providerLastName" class="form-control" data-error="Please enter provider Last Name." disabled></input>
							<div class="help-block with-errors"></div>
						</div>
						
					</div>
					<div class="row">
						<div class="form-group col-xs-6" >
							<label class="control-label" for="address">Provider Address:</label>
							<input type="text" name="providerAddress" class="form-control" data-error="Please enter provider address." disabled />
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group col-xs-6" >
							<label class="control-label" for="long">Provider Business Phone:</label>
							<input name="providerBusinessPhone" class="form-control" data-error="Please enter provider bussines phone." disabled></input>
							<div class="help-block with-errors"></div>
						</div>
					</div>
				</div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</body>
</html>