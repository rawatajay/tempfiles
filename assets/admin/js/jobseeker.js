var baseurl = $("#baseurl").val();
$("#formError").hide();
var save_method;
$(function() {
	$('#example').DataTable({
		responsive: true
	});
});

function add_form()
{
    save_method = 'add';
    $('#jobseekerlist')[0].reset(); // reset form on modals        
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Job Seeker'); // Set Title to Bootstrap modal title
}


function editjobseeker(id){
    $("#formError").hide();
    $("#errMsg").html('');
    save_method = 'update';   
    $.ajax({
        url : baseurl+'admin/user/edit/',
        data : {"id": id},
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {        	
            $('[name="_id"]').val(data.userID);
            $('[name="firstName"]').val(data.firstName);
            $('[name="lastName"]').val(data.lastName);
            $('[name="email"]').val(data.email); 
            $('[name="phone"]').val(data.phone);           
            if(data.isActive == 1){
            	$( "#s2" ).prop( "checked", true );
            }else if(data.isActive == 0){
            	$("#s1").prop("checked",true);
            }
            $('#modal_form').modal('show'); 
            $('.modal-title').text('Edit Job Seeker'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function jksave()
{
    $("#formError").hide();
    $("#errMsg").html('');
    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "person/ajax_add";
    } else {
        url = baseurl+"admin/user/save";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#jobseekerlist').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                $("#formError").hide();
                $("#errMsg").html('');
                succesAlertData();	
               // location.reload();
            }
            else
            {
            	$("#formError").show();
            	$("#errMsg").html(data.message);
            }
            $('#btnSave').text('Save changes'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Save changes'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function deletejobseeker(id)
{    
    swal({
        title: "Are you sure to delete?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {
            jobseekerdelete(id);
            swal({
                title: "Deleted!",
                text: "User has been deleted successfully.",
                type: "success",
                confirmButtonClass: "btn-success"
            },function(){
                setTimeout(function () {    
                    location.reload();
                },100);
            });
        } else {
            swal({
                title: "Cancelled",
                text: "",
                type: "error",
                confirmButtonClass: "btn-danger"
            });
        }
    });  
}

function jobseekerdelete(id){
    $.ajax({
        url : baseurl+"admin/user/delete",
        type: "POST",
        data:{"id" :id},
        dataType: "JSON",
        success: function(data)
        {   
            $('#modal_form').modal('hide');           
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(errorThrown);
            alert('Error deleting data');
        }
    });
}   
function succesAlertData(){
    swal({
        title: "Success!",
        text: "You data saved successfully!",
        type: "success",
        confirmButtonClass: "btn-success",
        confirmButtonText: "Success"
    },
    function () {
        setTimeout(function () {    
            location.reload();
        },100);
    });        
 }
