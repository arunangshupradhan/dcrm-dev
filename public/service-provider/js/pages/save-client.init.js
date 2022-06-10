$(document).ready(function(){
	$('#country').select2({
		placeholder: "Select a country",
		allowClear: false,
		ajax: {
			url: site_url+'ajax/get-dd/country-list',
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					searchTerm: params.term
				};
			},
			processResults: function (response) {
				return {
					results: response
				};
			},
			cache: true
		}
	}).on('change', function(){
		$('#state, #city').html('');
	});

	$('#state').select2({
		placeholder: "Select a State",
		allowClear: false,
		ajax: {
			url: site_url+'ajax/get-dd/state-list',
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					searchTerm: params.term,
					countryId: $('#country').find(':selected').val()
				};
			},
			processResults: function (response) {
				return {
					results: response
				};
			},
			cache: true
		}
	}).on('change', function(){
		$('#city').html('');
	});

	$('#city').select2({
		placeholder: "Select a city",
		allowClear: false,
		ajax: {
			url: site_url+'ajax/get-dd/city-list',
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					searchTerm: params.term,
					stateId: $('#state').find(':selected').val()
				};
			},
			processResults: function (response) {
				return {
					results: response
				};
			},
			cache: true
		}
	});

	if ($('#phone').length >= 1) {
		var input = document.querySelector("#phone");
		var errorMap = ["Invalid number", "Invalid country code", "Number is Too short", "Number is Too long", "Invalid number"];
		var iti = window.intlTelInput(input, {
			allowDropdown:true,
			separateDialCode:false,
			formatOnDisplay: false,
			utilsScript: site_url+"global/libs/intl-input/utils.js?1638200991544"
		});
		
		input.addEventListener('blur', function() {
			if (input.value.trim()) {
				if (iti.isValidNumber()) {
					var number = iti.getNumber(intlTelInputUtils.numberFormat.E164);
					input.value = number;	
				} else {
					var errorCode = iti.getValidationError();
					if (typeof iti.getSelectedCountryData().dialCode != 'undefined') {
						input.value = '+'+iti.getSelectedCountryData().dialCode;
					}
					if (parseInt(errorCode) > 0 || parseInt(errorCode) == '-99') {
						$.alert('Invalid Number');
						input.value = '';
					}else {
						$.alert(errorMap[errorCode]);
						input.value = '';
					}
				}
			}
		});
		input.addEventListener("countrychange", function() {
			if (typeof iti.getSelectedCountryData().dialCode != 'undefined') {
				input.value = '+'+iti.getSelectedCountryData().dialCode;
			}
		});
	};

	$("#form-new-client").submit(function (e) {
		event.preventDefault();
		let $parent = jQuery(this),
		btn = $parent.find('button[type=submit]');
		btnText = btn.html();
		btn.toggleClass("btn-primary btn-dark").html(btnReplace).prop('disabled', true);

		var formData = new FormData($("#form-new-client")[0]);
		$.ajax({
			url: $parent.attr('action'),
			type: 'POST',
			data: formData,
			async: true,
			success: function (data) {
				var JsonObject= JSON.parse(data);
				if (JsonObject.success) {
					$("[name='csrf_token_name']").val(JsonObject.hash);
					$('.error-input-feedback').text('');
					btn.toggleClass("btn-primary btn-dark").html(btnText).prop('disabled', false);
					success(JsonObject.message);
				} else {
					$('.error-input-feedback').text('');
					$("[name='csrf_token_name']").val(JsonObject.hash);
					let errors = JsonObject.error;
					showTabs(JsonObject.tab);
					$.each(errors , function (index, value){    
						$(index).parents('div.field-holder').find('.error-input-feedback').text(value);
					});
					btn.toggleClass("btn-primary btn-dark").html(btnText).prop('disabled', false);
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});

	$("#form-update-client-details").submit(function (e) {
		event.preventDefault();
		let $parent = jQuery(this),
		btn = $parent.find('button[type=submit]');
		btnText = btn.html();
		btn.toggleClass("btn-primary btn-dark").html(btnReplace).prop('disabled', true);

		var formData = new FormData($("#form-update-client-details")[0]);
		$.ajax({
			url: $parent.attr('action'),
			type: 'POST',
			data: formData,
			async: true,
			success: function (data) {
				var JsonObject= JSON.parse(data);
				if (JsonObject.success) {
					$("[name='csrf_token_name']").val(JsonObject.hash);
					$('.error-input-feedback').text('');
					btn.toggleClass("btn-primary btn-dark").html(btnText).prop('disabled', false);
					success(JsonObject.message);
				} else {
					$('.error-input-feedback').text('');
					$("[name='csrf_token_name']").val(JsonObject.hash);
					let errors = JsonObject.error;
					$.each(errors , function (index, value){    
						$(index).parents('div.field-holder').find('.error-input-feedback').text(value);
					});
					if (typeof JsonObject.message != 'undefined') {
						error(JsonObject.message);
					}
					btn.toggleClass("btn-primary btn-dark").html(btnText).prop('disabled', false);
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});

	$("#form-update-client-auth-details").submit(function (e) {
		event.preventDefault();
		let $parent = jQuery(this),
		btn = $parent.find('button[type=submit]');
		btnText = btn.html();
		btn.toggleClass("btn-primary btn-dark").html(btnReplace).prop('disabled', true);

		var formData = new FormData($("#form-update-client-auth-details")[0]);
		$.ajax({
			url: $parent.attr('action'),
			type: 'POST',
			data: formData,
			async: true,
			success: function (data) {
				var JsonObject= JSON.parse(data);
				if (JsonObject.success) {
					$("[name='csrf_token_name']").val(JsonObject.hash);
					$('.error-input-feedback').text('');
					btn.toggleClass("btn-primary btn-dark").html(btnText).prop('disabled', false);
					success(JsonObject.message);
				} else {
					$('.error-input-feedback').text('');
					$("[name='csrf_token_name']").val(JsonObject.hash);
					let errors = JsonObject.error;
					$.each(errors , function (index, value){    
						$(index).parents('div.field-holder').find('.error-input-feedback').text(value);
					});
					if (typeof JsonObject.message != 'undefined') {
						error(JsonObject.message);
					}
					btn.toggleClass("btn-primary btn-dark").html(btnText).prop('disabled', false);
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});
});