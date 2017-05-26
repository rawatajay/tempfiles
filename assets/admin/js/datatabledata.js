var tabledata = $('#adminAttandanceDatable').dataTable({
	"bServerSide": true,
	"bProcessing": true,
	"oSearch": {"bSmart": false},
	"sAjaxSource":  SITEBASEURL+"admin/getAttandanceData",
	"oLanguage": {
		"sProcessing": "",
	},		
	"fnServerParams": function ( aoData ) {
		aoData.push( { "name": "monthyear","value":$("#monthYear").val()} );
	},
	"aoColumnDefs": [{
	  		"aTargets": [ 5 ],
	  		 "mData": function ( source, type, val ) {
	  		 	//console.log(source[5]);
	  		 	if(source[5]=="present")
					var labelClass = 'label-success';
				else if(source[5]=="yellow")
					var labelClass = 'label-warning';
				else if(source[5]=="absent")
					var labelClass = 'label-danger';
				else if(source[5]=="half")
					var labelClass = 'label-default';
				
	  		 	return "<span class='label "+labelClass+"'>"+source[5]+"</span>"; 
	  		 },
	  		 "bSortable": true
		}
	],

	}); 

	$('.getmonthlyattandance').click(function() {
		tabledata.fnDraw();
	})

// some change in employee attndance funtion in progress.
var empoyeetabledata = $('#employeeAttandanceDatable').dataTable({
	"bServerSide": true,
	"bProcessing": true,
	"oSearch": {"bSmart": false},
	"sAjaxSource":  SITEBASEURL+"employee/getAttandanceData",
	"oLanguage": {
		"sProcessing": "",
	},		
	"fnServerParams": function ( aoData ) {
		aoData.push( { "name": "monthyear","value":$("#monthYear").val()} );
	},
	"aoColumnDefs": [{
	  		"aTargets": [ 5 ],
	  		 "mData": function ( source, type, val ) {
	  		 	//console.log(source[5]);
	  		 	if(source[5]=="present")
					var labelClass = 'label-success';
				else if(source[5]=="yellow")
					var labelClass = 'label-warning';
				else if(source[5]=="absent")
					var labelClass = 'label-danger';
				else if(source[5]=="half")
					var labelClass = 'label-default';
				
	  		 	return "<span class='label "+labelClass+"'>"+source[5]+"</span>"; 
	  		 },
	  		 "bSortable": true
		}
	],

	}); 

	$('.getemployeemonthlyattandance').click(function() {
		empoyeetabledata.fnDraw();
	})