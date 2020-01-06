
$(document).ready(function() {
	$("#login_form").validate({

		submitHandler : function(form) {
			form.submit();
		},
		rules : {
			password : {
				required : true,
				minlength : 5,
				normalizer : function(value) {
					return $.trim(value);
				}
			},
			email : {
				required : true,
				email : true,
				minlength : 5,

				remote : {
					url : checkEmailUrl,
					type : "post",
					dataType : "json",

				}

			},

		},
		messages : {

			// password : {
			// required : "Please provide a password",
			// minlength : "Your password must be at least 5 characters long"
			// },
			//
		/*	email : {
				// email : "Please enter a valid email address",
				// minlength : "Please type in an email.",
				// required : "Please type in an email.",
				remote : "This Account does not exist."
			//
			}*/

		},
		errorElement : "em",
		errorPlacement : function(error, element) {
			// Add the `invalid-feedback` class
			// to the error element
			error.addClass("invalid-feedback");

			if (element.prop("type") === "checkbox") {
				error.insertAfter(element.next("label"));
			} else {
				error.insertAfter(element);
			}
		},
		highlight : function(element, errorClass, validClass) {
			$(element).addClass("is-invalid").removeClass("is-valid");
		},
		unhighlight : function(element, errorClass, validClass) {
			$(element).addClass("is-valid").removeClass("is-invalid");
		}
	});

});