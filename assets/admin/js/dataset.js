var baseurl = $("#baseurl").val();
$("#formError").hide();


$("#_getCompanyCountClick").click(function () {
	$("#_totCompany").hide();
    var str = "";
    var employeRangeids = "";
    $("#citydata option:selected").each(function () {
    str += $(this).val() + ",";
    });

    $("#emprange option:selected").each(function () {
    employeRangeids += $(this).val() + ",";
    });

    var funclistid = $("#funcArea").val();

    str =str.slice(0,-1)
   
    $.ajax({
    url : baseurl+'admin/getTotCompanies',
    data : {"cities": str ,"emprange" : employeRangeids ,"industry" : funclistid},
    type: "POST",
    dataType: "JSON",
    success: function(data)
    {
        $('#datacount').val(data);
        $("#_totalCompany").show();
        $(".countsCompany").html(data);    
       
    }
    });
    

})

function dataset_save(method)
{
    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
    
    if(method == 'add') {
        url = baseurl+"admin/dataset/add";
    } else if(method=='update') {
        url = baseurl+"admin/dataset/update";
    }

    $.ajax({
        url : url,
        type: "POST",
        data: $('#datasetform').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) {   
               succesAlert(baseurl+"admin/datasetlist");		              
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

function succesAlert(reload){
    swal({
        title: "Success!",
        text: "Dataset saved successfully!",
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

function dataset_delete(id){
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
            datasetdeleteData(id);
            swal({
                title: "Deleted!",
                text: "Company has been deleted successfully.",
                type: "success",
                confirmButtonClass: "btn-success"
            },function(){
                setTimeout(function () {    
                    window.location.href = baseurl+"admin/datasetlist";
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

function datasetdeleteData(id){
    $.ajax({
        url : baseurl+"admin/dataset/delete",
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

 $(window).load(function() {
    // get selected state
    if($("#_dID").val()){    
        _getState($("#_conID").val());        
        _getCity($("#_stID").val());  
    }
    
});