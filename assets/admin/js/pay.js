$(document).ready(function (){
    
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
  
         $('#blockui-block-element-default').on('click', function() {       
            var lastValue=$('#amount').val();
             if (isNaN(lastValue)){  errorAlertdd("Please select valid amount!"); return false;}
             if(lastValue<=0 ){  errorAlertdd("Please select  amount!"); return false;} 
               $('#blockui-element-container-default').block({
                 message: '<div class="blockui-default-message"><i class="fa fa-circle-o-notch fa-spin"></i><h6>We are processing your request. <br> Please be patient.</h6></div>',
                 overlayCSS:  {
                         background: 'rgba(142, 159, 167, 0.8)',
                         opacity: 1,
                         cursor: 'wait'
                 },
                 css: {
                         width: '50%'
                 },
                 blockMsgClass: 'block-msg-default'
                 
         });
          
            
              setTimeout(function() {
                 $('#blockui-element-container-default').unblock()
         }, 2000);
              var payuForm = document.forms.payuForm; 
              payuForm.submit();
         });

        var hash = document.getElementById('hash').value;
        if(hash==''){
            return false;
        }else{
            var payuForm = document.forms.payuForm;

             payuForm.submit();
        }
  
  
            
              
});


function pay_process(data){
    var val = data;
    var lastValue=$('#amount').val();
    var total    = Number(lastValue) + Number(val);
    if(total>=2000 ){  errorAlertdd("You have exceeded your amount!"); return false;} 
    else{
      $('#amount').val(total);
    }
}