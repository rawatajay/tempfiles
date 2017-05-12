
<html>
  <head>


  	<link rel="stylesheet" type="text/css" href="http://rvera.github.io/image-picker/image-picker/image-picker.css">

  	<script type="text/javascript" src="http://rvera.github.io/image-picker/js/jquery.min.js" ></script>
  	<script type="text/javascript" src="image-picker/image-picker.js"></script>

  
  	
  
  </head>
  <body>
  	<select class="image-picker " >

	  <option data-img-src="img/01.png" value="1">  Page 1  </option>
	  <option data-img-src="img/02.png" value="2">  Page 2  </option>
	  <option data-img-src="img/03.png" value="3">  Page 3  </option>
	  <option data-img-src="img/04.png" value="4">  Page 4  </option>
	  <option data-img-src="img/05.png" value="5">  Page 5  </option>
	  <option data-img-src="img/06.png" value="6">  Page 6  </option>
	  <option data-img-src="img/07.png" value="7">  Page 7  </option>
	
	</select>

	<script type="text/javascript">
  	

    jQuery("select.image-picker").imagepicker({
      hide_select:  true,

    });

   

  	</script>

  </body>
</html>