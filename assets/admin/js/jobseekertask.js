              $(document).ready(function(){
                        $.blockUI({
                       overlayCSS:  {
                               background: 'rgba(142, 159, 167, 0.3)',
                               opacity: 1,
                               cursor: 'wait'
                       },
                       css: {
                               width: 'auto',
                               top: '40%',
                              left: '48%'
                       },
                       message: '<div class="blockui-default-message"><i class="fa fa-circle-o-notch fa-spin"></i></div>',
                       blockMsgClass: 'block-msg-message-loader'
               });
               setTimeout($.unblockUI, 2000);
  
                      // $('.summernote1').summernote();
                     

                      
                       $(".summernote").summernote({     
                             minHeight: 200,  
                            styleWithSpan: true,
                             toolbar: [
                                        ['style', ['style']],
                                        ['font', ['bold', 'italic', 'underline', 'clear']],
                                        ['fontname', ['fontname']],
                                        ['color', ['color']],
                                        ['para', ['ul', 'ol', 'paragraph']]
                                        
                                    ]
                       });
                       
                          $('.uploadImg').on("change", function(){
                              
                             var myFile   = $(this).prop('files');
                             var filename =  $(this).prop('name');    
                              var fileID  =   $(this).prop('id'); 
                              ajax_upload(myFile,filename,fileID);
                           });
         
                          
                        $('#example').DataTable({
				autoFill: true
			});   
                        
                        
	              $("#search-box").keyup(function(){
                          
		     $.ajax({
		     type: "POST",
	             url: baseurl+"user/dataset/getcityDatafilter",
		    data:'keyword='+$(this).val(),
		  beforeSend: function(){
			//$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		  },
		   success: function(data){
                       
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	     });
                    
           });
     
           
             
                
                
            function searchdataset(){
            
               var form_data =  $('#searchform').serialize();
            $.ajax({
               type:"POST" ,
               url : baseurl+"user/dataset/getdatasetdata",
               data: form_data,
               success: function(data){
                        $('.serch-data').html(data) ;      
                 }
            });
            
           }
                function selectCountry(val ,id) {
                    $("#search-box").val(val);
                    $("#cityID").val(id);
                    $("#suggesstion-box").hide();
                 }    
     
 
        function getmailpreview(){
            
            if(!$('#mail_subject').val() ){
               errorAlertdd("Please fill email subject !");
            }else if(!$('#mailID').val()){
                errorAlertdd("Pease select mail template !"); 
              }else{
                $('.bd-example-modal-lg').modal('show');
                
                
            var form_data =  $('#mailform').serialize();
            $.ajax({
               type:"POST" ,
               url:baseurl+"user/dataset/getpreviewmail",
               data: form_data,
               success: function(data){
                        $('.pre-mail').html(data) ;      
                 }
            });
            }
        }
         

       function sendingMailData(){
       
            var form_data =  $('#mailform').serialize();
            
            
            $.ajax({
               type:"POST" ,
               url:baseurl+"user/dataset/sendmail",
               data: form_data,
                
               success: function(data){
                  
                   $('.bd-example-modal-lg').modal('hide');
                          
                   succesAlert(baseurl+"user/userDatasetlistData");	
                           
                          
                 }   
            });
        }
        
        function succesAlert(reload){
        swal({
            title: "Success!",
            text: "message sent successfully!",
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
 
          
    function errorAlertdd(msg){
    swal({
        title: "Error!",
        text: msg,
        type: "error",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Error"
    });
      
 } 
 
                           function ajax_upload(files,name,id) {		
     
                                       var barid = "#progress-bar"+id;
					$('#progress'+id).removeClass('hidden');
				//	$('.progress-bar').css({ "width": "0%" });
				//	$('.progress-bar span').html('0% complete');	
					$(barid).css({ "width": "0%" });
					$(barid +'  span').html('0% complete');	
				
                                
					var formData = new FormData();					
                                              
					for (var i = 0; i < files.length; i++) {
						 
						formData.append(name, files[i]);
					}						
			          
                              
					$.ajax({
						url : baseurl+"user/uploadFileData", // Change name according to your php script to handle uploading on server
						type : 'post',
						data : formData,
						dataType : 'json',						
						processData: false,
						contentType: false,
						error : function(request){
							ajax_msg(false, 'An error has occured while uploading photo.'); 								
						},
						success : function(json){
							setTimeout(location.reload.bind(location), 1000);															
							     if(json.error != null) 
								ajax_msg(false, json.error);
						},
						progress: function(e) {
							if(e.lengthComputable) {
								var pct = (e.loaded / e.total) * 100;
//								$('.progress-bar').css({ "width": pct + "%" });	
//								$('.progress-bar span').html(pct + '% complete');
                                                                $(barid).css({ "width": pct + "%" });	
								$(barid + ' span').html(pct + '% complete');
							}
							else {
								console.warn('Content Length not reported!');
							}
						}
					});					
				}
				
                                

                            (function($, window, undefined) {
                            var hasOnProgress = ("onprogress" in $.ajaxSettings.xhr());

                            if (!hasOnProgress) {
                                    return;
                            }

                            var oldXHR = $.ajaxSettings.xhr;
                            $.ajaxSettings.xhr = function() {
                                    var xhr = oldXHR();
                                    if(xhr instanceof window.XMLHttpRequest) {
                                            xhr.addEventListener('progress', this.progress, false);
                                    }

                                    if(xhr.upload) {
                                            xhr.upload.addEventListener('progress', this.progress, false);
                                    }

                                    return xhr;
                            };
                    })(jQuery, window);
                    
                                     