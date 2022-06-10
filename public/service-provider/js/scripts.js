$(document).ready(function(){
	"use strict";
	$(".basicDatatable").DataTable({lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],keys:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});var a=$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","print"],language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});

	//tooltip
	$('[data-toggle="tooltip"]').tooltip();

	$(document).on('keypress', '.char', function(e){
		var key = e.keyCode;
		if (key >= 48 && key <= 57) {
			e.preventDefault();
		}
	});

	/*WILL KEEP TAB ACTIVE EVEN AFTER PAGE RELOAD*/
	// $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
	// 	localStorage.setItem('activeTab', $(e.target).attr('href'));
	// });
	// var activeTab = localStorage.getItem('activeTab');
	// if(activeTab){
	// 	$('#parentTabHolder a[href="' + activeTab + '"]').tab('show');
	// }

	$(document).on('keypress', '.numbers', function(evt){
		if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
		{
			evt.preventDefault();
		}
	});

	$(".decimal").on("input", function(evt) {
		var self = $(this);
		self.val(self.val().replace(/[^0-9\.]/g, ''));
		if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
		{
			evt.preventDefault();
		}
	});

	$(document).on('keyup', '.user-name', function(evt){
		let $val = $(this).val();
		if ($val != '') {
			let $updatedVal = $val.replace(/\s+/, "");
			$(this).val($updatedVal);
		}
		// .
	});

	$(document).on('keyup', ".uppercase", function () {
		var $val = $(this).val();
		$(this).val($val.toUpperCase());
	});

	$( document ).ajaxComplete(function() {
		$('[data-toggle="tooltip"]').tooltip({
			"html": true,
			"delay": {"show": 1000, "hide": 0},
		});
	});
});
