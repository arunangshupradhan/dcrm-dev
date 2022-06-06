$(document).ready(function(){
	"use strict";
	var formProgress = 'formSubmitProgress',
	btnProgress = 'btn-progress',
	x_timer,
	btnReplace = '<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Loading',
	btnText = '';
	
	$("#defaultBtn").click("#defaultForm", function (e) {
		event.preventDefault();
		// $('#defaultForm').addClass(formProgress);
		btnText = $('#defaultBtn').html();
		$('#defaultBtn').toggleClass("btn-primary btn-dark").html(btnReplace).prop('disabled', true);
		var formData = new FormData($("#defaultForm")[0]);

		$('.ckedCus').each(function(e){
			let $this = jQuery(this),
			$class = $this.attr('name');
			var description = CKEDITOR.instances[$class].getData()
			formData.append($class, description);
			clearTimeout(x_timer);

		});
		clearTimeout(x_timer);
		x_timer = setTimeout(function(){
			invokeFormSubmit('#defaultForm', formData, '#defaultBtn');
		}, 1000);
	});

	function invokeFormSubmit(formIdentifier, formData, btn, isModal=false) {
		$.ajax({
			url: $(formIdentifier).attr('action'),
			type: 'POST',
			data: formData,
			async: true,
			success: function (data) {
				var JsonObject= JSON.parse(data);
				if (JsonObject.success) {
					$("[name='csrf_token_name']").val(JsonObject.hash);
					$(btn).toggleClass("btn-primary btn-dark").html(btnText).prop('disabled', false);
					// $(formIdentifier).removeClass(formProgress);
					if (isModal) {
						$(isModal).modal('hide');
					}
					success(JsonObject.message, JsonObject.reload, JsonObject.redirect);
				} else {
					$("[name='csrf_token_name']").val(JsonObject.hash);
					$(btn).toggleClass("btn-primary btn-dark").html(btnText).prop('disabled', false);
					// $(formIdentifier).removeClass(formProgress);
					if (JsonObject.name != '') {
						$(JsonObject.tab).click();
						setTimeout(function() {
							$(JsonObject.id).focus();
						}, 500);
					}
					error(JsonObject.message);
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	};

	var _URL = window.URL || window.webkitURL;
	$(".twohundredXhundred").change(function(e) {
		var file, img, parent  = jQuery(this);
		if ((file = this.files[0])) {
			img = new Image();
			img.src = e.target.result;
			img.onload = function() {
				if ((this.width != 200) || (this.height != 100)) {
					$.alert('Image size must be 200 X 100 pixels');
					parent.val('');
					if (parent.parents('.holder').find('embed').length > 0) {
						parent.parents('.holder').find('embed').attr('src', site_url+'public/headoffice/images/default/defaultImage.png');
					}
				}
			};
			img.onerror = function() {
				$.alert( "not a valid file: " + file.type);
				parent.val('');
				if (parent.parents('.holder').find('embed').length > 0) {
					parent.parents('.holder').find('embed').attr('src', site_url+'public/headoffice/images/default/defaultImage.png');
				}
			};
			img.src = _URL.createObjectURL(file);
		}
	});

	$(document).on('click', '.deletePlan', function(e){
		e.preventDefault();
		let $id = $(this).attr('data-delete');
		$.confirm({
			title: 'Confirm!',
			content: "Are you sure? You want to delete this plan?",
			icon: 'fa fa-warning',
			type: 'blue',
			theme: 'light',
			autoClose: 'No|5000',
			buttons: {
				omg: {
					text: 'Yes',
					btnClass: 'btn-dark',
					action: function () {
						window.location.href = site_url+"admin/plan/delete-plan/"+$id;
					}
				},
				No: function(){
				}
			}
		});
	});

	$(document).on('click', '.editPlans', function(e){
		e.preventDefault();
		let parent = $(this);
		$.ajax({
			type: 'POST',
			url: site_url+'admin/plan/get-plan',
			data: {
				'id': parent.attr('data-edit'),
				csrf_token_name: $("[name='csrf_token_name']").val(),
			},
			success: function (data) {
				var JsonObject= JSON.parse(data);
				if (JsonObject.success) {
					$("[name='csrf_token_name']").val(JsonObject.hash);
					$('#defaultForm').trigger('reset').attr('action', site_url+'admin/plan/add-plan/'+JsonObject.details['id']);
					$('#planCanvas .card-title').text('Update Plan');
					$('#planCanvas #defaultBtn').html('<i class="dripicons-plus bx font-size-16 align-middle"></i> Update Plan');
					$('#plan_name').val(JsonObject.details['plan_name']);
					$('#number_of_client').val(JsonObject.details['number_of_client']);
					$('#storage_capacity').val(JsonObject.details['storage_capacity']);
					$('#plan_rate').val(JsonObject.details['plan_rate']);


					$('#planCanvas').offcanvas('toggle')
				} else {
					$("[name='csrf_token_name']").val(JsonObject.hash);
				}
			}
		},'json');
	});

	$(document).on('click', '.addPlan', function(e){
		e.preventDefault();
		$('#defaultForm').trigger('reset').attr('action', site_url+'admin/plan/add-plan/');
		$('#planCanvas .card-title').text('Add New Plan');
		$('#planCanvas #defaultBtn').html('<i class="dripicons-plus bx font-size-16 align-middle"></i> Add Plan');
		$('#planCanvas').offcanvas('toggle')
	});
});
