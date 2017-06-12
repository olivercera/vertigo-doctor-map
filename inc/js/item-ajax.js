$( document ).ready(function() {
    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var items_per_page = 10;
    var is_ajax_fire = 0;
    var visiblePages = 5;

    manageData();

    /* manage data list */
    function manageData() {
        $.ajax({
            dataType: 'json',
            url: url+'api/getData.php',
            data: {page:page,items_per_page:items_per_page}
        }).done(function(data){
        	total_page = Math.ceil(data.total/items_per_page);
        	current_page = page;

        	$('#pagination').twbsPagination({
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
    	$.ajax({
        	dataType: 'json',
        	url: url+'api/getData.php',
        	data: {page:page,items_per_page:items_per_page}
    	}).done(function(data){
    		manageRow(data.data);
    	});
    }


    /* Add new Item table row */
    function manageRow(data) {
    	var	rows = '';
    	$.each( data, function( key, value ) {
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

    	$("tbody").html(rows);
    }

    /* Create new Item */
    $(".crud-submit").click(function(e){
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");
        var npi = $("#create-item").find("input[name='npi']").val();
        var lastname = $("#create-item").find("input[name='providerLastName']").val();
        var firstname = $("#create-item").find("input[name='providerFirstName']").val();
        var address = $("#create-item").find("input[name='providerAddress']").val();
        var level = $("#create-item").find("input[name='providerLevel']").val();
        var phone = $("#create-item").find("input[name='providerBusinessPhone']").val();

         if(address != '' && npi != '' && lastname != '' && firstname != '' && level != '' && phone != ''){
            $.ajax({
                dataType: 'json',
                type:'POST',
                url: url + form_action,
                data:{address:address, npi:npi, lastname:lastname, firstname:firstname, level:level, phone:phone}
            }).done(function(data){
                $("#create-item").find("input[name='address']").val('');
                $("#create-item").find("textarea[name='lat']").val('');
                $("#create-item").find("textarea[name='long']").val('');
                getPageData();
                $(".modal").modal('hide');
                toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
            });
        }else{
            alert('You are missing title or description.')
        }


    });

    /* Remove Item */
    $("body").on("click",".remove-item",function(){
        var id = $(this).parent("td").data('id');
        var c_obj = $(this).parents("tr");

        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url + 'api/delete.php',
            data:{id:id}
        }).done(function(data){
            c_obj.remove();
            toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
            getPageData();
        });

    });


    /* Edit Item */
    $("body").on("click",".edit-item",function(){

        var id = $(this).parent("td").data('id');
        var firstname = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td") .text();
        var lastname = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var npi = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
        var address = $(this).parent("td").prev("td").prev("td").prev("td").text();
        var phone = $(this).parent("td").prev("td").prev("td").text();
        var level = $(this).parent("td").prev("td").text();

        $("#edit-item").find("input[name='providerAddress']").val(address);
        $("#edit-item").find("input[name='providerFirstName']").val(firstname);
        $("#edit-item").find("input[name='providerLastName']").val(lastname);
        $("#edit-item").find("input[name='providerBusinessPhone']").val(phone);
        $("#edit-item").find("input[name='npi']").val(npi);
        $("#edit-item").find("input[name='providerLevel']").val(level);

        $("#edit-item").find(".edit-id").val(id);

    });
    $("body").on("click",".view-item",function(){

        var id = $(this).parent("td").data('id');
         var firstname = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td") .text();
        var lastname = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var npi = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
        var address = $(this).parent("td").prev("td").prev("td").prev("td").text();
        var phone = $(this).parent("td").prev("td").prev("td").text();
        var level = $(this).parent("td").prev("td").text();

        $("#view-item").find("input[name='providerAddress']").val(address);
        $("#view-item").find("input[name='providerFirstName']").val(firstname);
        $("#view-item").find("input[name='providerLastName']").val(lastname);
        $("#view-item").find("input[name='providerBusinessPhone']").val(phone);
        $("#view-item").find("input[name='npi']").val(npi);
        $("#view-item").find("input[name='providerLevel']").val(level);

    });


    /* Updated new Item */
    $(".crud-submit-edit").click(function(e){

        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");
         var npi = $("#edit-item").find("input[name='npi']").val();
        var lastname = $("#edit-item").find("input[name='providerLastName']").val();
        var firstname = $("#edit-item").find("input[name='providerFirstName']").val();
        var address = $("#edit-item").find("input[name='providerAddress']").val();
        var level = $("#edit-item").find("input[name='providerLevel']").val();
        var phone = $("#edit-item").find("input[name='providerBusinessPhone']").val();


        var id = $("#edit-item").find(".edit-id").val();

         if(address != '' && npi != '' && lastname != '' && firstname != '' && level != '' && phone != ''){
            $.ajax({
                dataType: 'json',
                type:'POST',
                url: url + form_action,
                data:{id:id,address:address, npi:npi, lastname:lastname, firstname:firstname, level:level, phone:phone}
            }).done(function(data){
                console.log(data)
                getPageData();
                $(".modal").modal('hide');
                toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
            });
        }else{
            alert('You are missing title or description.')
        }

    });
});
