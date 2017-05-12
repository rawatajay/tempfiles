<script src="<?php echo base_url()?>assets/admin/js/lib/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/lib/tether/tether.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/plugins.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/angular.min.js"></script>
<input id="baseurl" type="hidden" value="<?php echo base_url(); ?>" />
<script src="<?php echo base_url()?>assets/admin/js/app.js"></script>
<?php
     if(isset($pageJS)):
	      foreach($pageJS as $JS){
	        echo '<script type="text/javascript" src="'.base_url().'assets/admin/'.$JS.'" ></script>';
	      }
     endif;
?>
<script>
	$(document).ready(function() {
		<?php 
			if(isset($initJsFunc)):
			foreach($initJsFunc as $fun){
			  echo $fun;
			}
		endif;
		?>	
	});
</script>
</body>
</html>