var baseurl = $("#baseurl").val();
$("#formError").hide();
var save_method;


function company_add()
{        
    save_method = 'add';
    $("#formError").hide();
    $('#companyform')[0].reset();
    window.location.href = baseurl+"admin/company";
}


function company_edit(id){
    
 
    save_method = 'update';   
    $.ajax({
        url : baseurl+'admin/company/edit',
        data : {"id": id},
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {   
            $('[name="_id"]').val(data.companyID);
            $('[name="companyName"]').val(data.companyName);                
            $('[name="contactName"]').val(data.primarycontactname);      
            $('[name="contactEmail"]').val(data.primaryEmail);                
            $('[name="website"]').val(data.website);                
            $('[name="contactNumber"]').val(data.contactnumbers); 
            $('[name="address"]').val(data.address);                
            $('[name="description"]').val(data.companydescription); 
            if(data.logo){
                $("#companyUploadedLogo").show();
                $('#companyUploadedLogo img').attr('src',baseurl+'uploads/companyLogo/'+data.logo);
                $('#_imgval').val(data.logo);
            }
            if(data.status == 1){
                $( "#s2" ).prop( "checked", true );
            }else if(data.status == 2){
                $("#s1").prop("checked",true);
            }
            $('#modal_form').modal('show'); 
            $('.modal-title').text('Edit Company'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function company_save(method)
{
    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
    
    if(method == 'add') {
        url = baseurl+"admin/company/add";
    } else if(method=='update') {
        url = baseurl+"admin/company/update";
    }

      var formData = new FormData($("#companyform")[0]);
   //    console.log(formData);
      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        async: false,
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
           success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                $("#formError").hide();
                $("#errMsg").html('');
                succesAlert(baseurl+"admin/companylist");	

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
     
    /*  return false;
   

    $.ajax({
        url : url,
        type: "POST",
        data: $('#jobtypeform').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            console.log(data.status);
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                $("#formError").hide();
                $("#errMsg").html('');
                succesAlert();	              
            }
            else
            {
                console.log("asd");
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
    });   */
}







/*
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
            deleteData(id);
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

function deleteData(id){
    $.ajax({
        url : baseurl+"admin/jobseeker/delete",
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
}      */


function company_delete(id)
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
            companydeleteData(id);
            swal({
                title: "Deleted!",
                text: "Company has been deleted successfully.",
                type: "success",
                confirmButtonClass: "btn-success"
            },function(){
                setTimeout(function () {    
                    window.location.href = baseurl+"admin/companylist";
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

function companydeleteData(id){
    $.ajax({
        url : baseurl+"admin/company/delete",
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
function succesAlert(reload){
    swal({
        title: "Success!",
        text: "Company saved successfully!",
        type: "success",
        confirmButtonClass: "btn-success",
        confirmButtonText: "Success"
    },
    function () {
        setTimeout(function () {    
            window.location.href = reload;
        },100);
    });        
 }

 function _getState(country){
    
    $("#citydata").select2("val", "");
    $('#citydata').empty();
    $("#_totCompany").hide();
    $.ajax({
        url : baseurl+'admin/state',
        data : {"country": country},
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            $('#statedata').empty();
            $.each(data, function(key, value) {              
                $('#statedata')
                .append($("<option></option>")
                .attr("value",value.id)
                .text(value.name)); 
            });
           // $( "#statedata" ).trigger( "change");
           if($("#_cID").val()  || $("#_dID").val()){
                $("#statedata").val($("#_stID").val());                
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
 }
function _getCity(state){  

    $("#_totCompany").hide();  
    $.ajax({
        url : baseurl+'admin/city',
        data : {"state": state},
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            $('#citydata').empty();
            $.each(data, function(key, value) {              
                $('#citydata')
                .append($("<option></option>")
                .attr("value",value.id)
                .text(value.name)); 
            });
             // $( "#statedata" ).trigger( "change");

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        },
        complete : function(){
            if($("#_cID").val()  || $("#_dID").val()){
            
                var selectedValues = $("#_ciID").val().split(',');
                 $("#citydata").val(selectedValues);  
                   $("#citydata").select2();            
            }
        }
    });
 }



$(window).load(function() {
    // get selected state
    if($("#_cID").val()){   
    

        _getState($("#_conID").val());        
        _getCity($("#_stID").val());  
    }
    
});
 

