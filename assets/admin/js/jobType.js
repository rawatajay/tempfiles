var baseurl = $("#baseurl").val();
$("#formError").hide();
var save_method;


function add_form()
{
    save_method = 'add';
    $("#formError").hide();
    $('#jobtypeform')[0].reset(); // reset form on modals        
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Job Type'); // Set Title to Bootstrap modal title
}


function editType(id){
    $("#formError").hide();
    $("#errMsg").html('');
    save_method = 'update';   
    $.ajax({
        url : baseurl+'admin/jobtype/edit',
        data : {"id": id},
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {              	
            $('[name="_id"]').val(data.jobtypeID);
            $('[name="title"]').val(data.type);                
            if(data.status == 1){
            	$( "#s2" ).prop( "checked", true );
            }else if(data.status == 2){
            	$("#s1").prop("checked",true);
            }
            $('#modal_form').modal('show'); 
            $('.modal-title').text('Edit Job Type'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function jobtypesave()
{
    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = baseurl+"admin/jobtype/add";
    } else {
        url = baseurl+"admin/jobtype/update";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#jobtypeform').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                $("#formError").hide();
                $("#errMsg").html('');
                succesAlert();	              
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

function deleteType(id)
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
            deleteTypeData(id);
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

function deleteTypeData(id){
    $.ajax({
        url : baseurl+"admin/jobtype/delete",
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
function succesAlert(){
    swal({
        title: "Success!",
        text: "Job Type saved successfully!",
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
