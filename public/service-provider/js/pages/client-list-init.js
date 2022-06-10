$(document).ready(function(){
	"use strict";
	var dtBranchList = $('#dtBranchList').DataTable({
		lengthMenu: [
		[20, 50, 70, 100],
		[20, 50, 70, 100]
		],
		keys: !0,
		language: {
			paginate: {
				previous: "<i class='fa-solid fa-angle-left'></i>",
				next: "<i class='fa-solid fa-angle-right'></i>"
			}
		},
		drawCallback: function() {
			$(".dataTables_paginate > .pagination").addClass("pagination-rounded")
		},
		'processing': true,
		'serverSide': true,
		'searching': false,
		'responsive': true,
		'searchDelay': 500,
		'lengthChange': true,
		'stateSave': true,
		'serverMethod': 'post',
		"info": true,
		'ajax': {
			'url':site_url+'head-office/ajax-dt-get-branch-list',
			'data': function(data){
				var keyword = $('#keyword').val();
				var stats = $('#statusType').find(':selected').val();
				data.csrf_token_name = $("[name='csrf_token_name']").val();
				data.status = stats;
				data.keyword = keyword;
				return {
					data: data
				};
			},
			dataSrc: function(data){
				$("[name='csrf_token_name']").val(data.hash);
				return data.aaData;
			}
		},
		'columnDefs': [ {
			'targets': [0,1,2,3,4,5], 
			'orderable': false, 
		}],
		'columns': [
		{ data: 'slNo' },
		{ data: 'branch_name' },
		{ data: 'academy_name' },
		{ data: 'branch_email' },
		{ data: 'status' },
		{ data: 'action' },
		],
		"fnDrawCallback": function (oSettings) {
			$('[data-toggle="tooltip"]').tooltip();
		}
	});

	$('#keyword').keyup(function(){
		clearTimeout(x_timer);
		x_timer = setTimeout(function(){
			dtBranchList.draw();
		}, 1000);
	});

	$('#statusType').change(function(){
		dtBranchList.draw();
	});
});
