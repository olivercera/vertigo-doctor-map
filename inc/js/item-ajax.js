jQuery( document ).ready(function() {
    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var items_per_page = 10;
    var is_ajax_fire = 0;
    var visiblePages = 5;

    manageData();

    /* manage data list */
    function manageData() {

        var params = {
          action: 'vertigo_doctor_get_data',
          page:page,
          items_per_page:items_per_page
        };
        jQuery.post(ajax_object.ajax_url, params, function(data) {
          var data = JSON.parse(data);
        	total_page = Math.ceil(data.total/items_per_page);
        	current_page = page;

        	jQuery('#pagination').twbsPagination({
    	        totalPages: total_page,
    	        visiblePages: visiblePages,
    	        onPageClick: function (event, pageL) {
    	        	page = pageL;
                    if(is_ajax_fire != 0){
    	        	  getPageData();
                    }
    	        }
    	    });

        	manageRow(data.data);
            is_ajax_fire = 1;

        });

    }

    /* Get Page Data*/
    function getPageData() {
        var params = {
          action: 'vertigo_doctor_get_data',
          page:page,
          items_per_page:items_per_page
        };
        jQuery.post(ajax_object.ajax_url, params, function(data) {
            var data = JSON.parse(data);
    	    manageRow(data.data);
    	});
    }


    /* Add new Item table row */
    function manageRow(data) {
    	var	rows = '';
    	jQuery.each( data, function( key, value ) {
    	  	rows = rows + '<tr>';
    	  	rows = rows + '<td>'+value.id+'</td>';
            rows = rows + '<td>'+value.provider_first_name+'</td>';
            rows = rows + '<td>'+value.provider_last_name+'</td>';
            rows = rows + '<td style="display:none">'+value.npi+'</td>';
    	  	rows = rows + '<td>'+value.provider_address+'</td>';
            rows = rows + '<td style="display:none">'+value.provider_business_loc_add_phone+'</td>';
            rows = rows + '<td style="display:none">'+value.provider_level+'</td>';
    	  	rows = rows + '<td data-id="'+value.id+'">';
            rows = rows + '<button data-toggle="modal" data-target="#view-item" class="btn btn-primary view-item">View</button> ';
            rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
            rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
            rows = rows + '</td>';
    	  	rows = rows + '</tr>';
    	});

    	jQuery("tbody").html(rows);
    }

    /* Create new Item */
    jQuery(".crud-submit").click(function(e){
        e.preventDefault();
        var form_action = jQuery("#create-item").find("form").attr("action");
        var npi = jQuery("#create-item").find("input[name='npi']").val();
        var lastname = jQuery("#create-item").find("input[name='providerLastName']").val();
        var firstname = jQuery("#create-item").find("input[name='providerFirstName']").val();
        var address = jQuery("#create-item").find("input[name='providerAddress']").val();
        var level = jQuery("#create-item").find("input[name='providerLevel']").val();
        var phone = jQuery("#create-item").find("input[name='providerBusinessPhone']").val();

         if(address != '' && npi != '' && lastname != '' && firstname != '' && level != '' && phone != ''){
            var params = {
              action: 'vertigo_doctor_create',
              address:address, 
              npi:npi, 
              lastname:lastname, 
              firstname:firstname, 
              level:level, 
              phone:phone
            };
            jQuery.post(ajax_object.ajax_url, params, function(data) {
              var data = JSON.parse(data);
                jQuery("#create-item").find("input[name='address']").val('');
                jQuery("#create-item").find("textarea[name='lat']").val('');
                jQuery("#create-item").find("textarea[name='long']").val('');
                getPageData();
                jQuery(".modal").modal('hide');
                toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
            });
        }else{
            alert('You are missing title or description.')
        }


    });

    /* Remove Item */
    jQuery("body").on("click",".remove-item",function(){
        var id = jQuery(this).parent("td").data('id');
        var c_obj = jQuery(this).parents("tr");
         var params = {
              action: 'vertigo_doctor_delete',
              id:id
        };
        jQuery.post(ajax_object.ajax_url, params, function(data) {
              var data = JSON.parse(data);
            c_obj.remove();
            toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
            getPageData();
        });

    });


    /* Edit Item */
    jQuery("body").on("click",".edit-item",function(){

        var id = jQuery(this).parent("td").data('id');
        var firstname = jQuery(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td") .text();
        var lastname = jQuery(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var npi = jQuery(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
        var address = jQuery(this).parent("td").prev("td").prev("td").prev("td").text();
        var phone = jQuery(this).parent("td").prev("td").prev("td").text();
        var level = jQuery(this).parent("td").prev("td").text();

        jQuery("#edit-item").find("input[name='providerAddress']").val(address);
        jQuery("#edit-item").find("input[name='providerFirstName']").val(firstname);
        jQuery("#edit-item").find("input[name='providerLastName']").val(lastname);
        jQuery("#edit-item").find("input[name='providerBusinessPhone']").val(phone);
        jQuery("#edit-item").find("input[name='npi']").val(npi);
        jQuery("#edit-item").find("input[name='providerLevel']").val(level);

        jQuery("#edit-item").find(".edit-id").val(id);

    });
    jQuery("body").on("click",".view-item",function(){

        var id = jQuery(this).parent("td").data('id');
         var firstname = jQuery(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td") .text();
        var lastname = jQuery(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var npi = jQuery(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
        var address = jQuery(this).parent("td").prev("td").prev("td").prev("td").text();
        var phone = jQuery(this).parent("td").prev("td").prev("td").text();
        var level = jQuery(this).parent("td").prev("td").text();

        jQuery("#view-item").find("input[name='providerAddress']").val(address);
        jQuery("#view-item").find("input[name='providerFirstName']").val(firstname);
        jQuery("#view-item").find("input[name='providerLastName']").val(lastname);
        jQuery("#view-item").find("input[name='providerBusinessPhone']").val(phone);
        jQuery("#view-item").find("input[name='npi']").val(npi);
        jQuery("#view-item").find("input[name='providerLevel']").val(level);

    });


    /* Updated new Item */
    jQuery(".crud-submit-edit").click(function(e){

        e.preventDefault();
        var form_action = jQuery("#edit-item").find("form").attr("action");
         var npi = jQuery("#edit-item").find("input[name='npi']").val();
        var lastname = jQuery("#edit-item").find("input[name='providerLastName']").val();
        var firstname = jQuery("#edit-item").find("input[name='providerFirstName']").val();
        var address = jQuery("#edit-item").find("input[name='providerAddress']").val();
        var level = jQuery("#edit-item").find("input[name='providerLevel']").val();
        var phone = jQuery("#edit-item").find("input[name='providerBusinessPhone']").val();


        var id = jQuery("#edit-item").find(".edit-id").val();

         if(address != '' && npi != '' && lastname != '' && firstname != '' && level != '' && phone != ''){
             var params = {
              action: 'vertigo_doctor_update',
              id:id, 
              address:address, 
              npi:npi, 
              lastname:lastname, 
              firstname:firstname, 
              level:level, 
              phone:phone
            };
            jQuery.post(ajax_object.ajax_url, params, function(data) {
              var data = JSON.parse(data);
                console.log(data)
                getPageData();
                jQuery(".modal").modal('hide');
                toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
            });
        }else{
            alert('You are missing title or description.')
        }

    });
});
