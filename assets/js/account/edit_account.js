

$(document)
		.ready(
				function() {
					$("#edit_account_validate")
							.validate(
									{
										
										submitHandler: function(form) {
										    form.submit();
										  },
										rules : {
											fname : {
												required : true,
												minlength : 3,
												maxlength: 50,
												lettersonly: true,
												normalizer : function(value) {
													return $.trim(value);
												}
											},
											lname : {
												required : true,
												minlength : 3,
												maxlength: 50,
												lettersonly: true,
												normalizer : function(value) {
													return $.trim(value);
												}

											},
											number : {
												required : true,
												minlength : 10,
												maxlength: 10,
												digits: true,
												normalizer : function(value) {
													return $.trim(value);
												}
											},
											
						
											
											password : {
												required : true,
												minlength : 3,
												maxlength: 200,
												

											},

										},
										messages : {

										

											

										},
										errorElement : "em",
										errorPlacement : function(error,
												element) {
											// Add the `invalid-feedback` class
											// to the error element
											error.addClass("invalid-feedback");

											if (element.prop("type") === "checkbox") {
												error.insertAfter(element
														.next("label"));
											} else {
												error.insertAfter(element);
											}
										},
										highlight : function(element,
												errorClass, validClass) {
											$(element).addClass("is-invalid")
													.removeClass("is-valid");
										},
										unhighlight : function(element,
												errorClass, validClass) {
											$(element).addClass("is-valid")
													.removeClass("is-invalid");
										}
									});

				});