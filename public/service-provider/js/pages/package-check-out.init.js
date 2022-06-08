$(document).ready(function(){
	$("#card_number").inputmask({'mask': '9999 9999 9999 9999'});
	$("#cvv").inputmask({'mask': '999'});
	$('#expiry_date').inputmask({alias: 'datetime', inputFormat: 'mm/yy'});

	$("#checkout-form").submit(function (e) {
		event.preventDefault();
		let $parent = jQuery(this),
		btn = $parent.find('button[type=submit]');
		btnText = btn.html();
		btn.toggleClass("btn-success btn-dark").html(btnReplace).prop('disabled', true);

		var formData = new FormData($("#checkout-form")[0]);
		$.ajax({
			url: $parent.attr('action'),
			type: 'POST',
			data: formData,
			async: true,
			success: function (data) {
				var JsonObject= JSON.parse(data);
				if (JsonObject.success) {
					$("[name='csrf_token_name']").val(JsonObject.hash);
					btn.toggleClass("btn-success btn-dark").html(btnText).prop('disabled', false);
					success(JsonObject.message);
				} else {
					$("[name='csrf_token_name']").val(JsonObject.hash);
					btn.toggleClass("btn-primary btn-dark").html(btnText).prop('disabled', false);
					error(JsonObject.message);
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});

});