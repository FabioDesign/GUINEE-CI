"use strict";

// Class definition
var KTContactsAdd = function () {
	// Base elements
	var _stepperEl;
	var _formEl;
	var _stepper;
	var _validations = [];
	var _hasValidation = true;

	// Gère l'affichage Previous/Next/Submit selon l'étape active
	var updateActionButtons = function (stepper) {
		var totalSteps = stepper.getTotalStepsNumber ? stepper.getTotalStepsNumber() : stepper.totatStepsNumber;
		var currentIndex = stepper.getCurrentStepIndex();

		var btnPrev = _stepperEl.querySelector('[data-kt-stepper-action="previous"]');
		var btnNext = _stepperEl.querySelector('[data-kt-stepper-action="next"]');
		var btnSubmit = _stepperEl.querySelector('[data-kt-stepper-action="submit"]');

		if (btnPrev) btnPrev.style.display = (currentIndex === 1) ? 'none' : 'inline-block';
		if (btnNext) btnNext.style.display = (currentIndex === totalSteps) ? 'none' : 'inline-block';
		if (btnSubmit) btnSubmit.style.display = (currentIndex === totalSteps) ? 'inline-block' : 'none';
	}

	// Private functions
	var initStepper = function () {
		// Initialiser le stepper (API Metronic v8 - remplace KTWizard)
		_stepper = new KTStepper(_stepperEl);

		// État initial des boutons (étape 1)
		updateActionButtons(_stepper);

		// Validation avant de passer à l'étape suivante
		_stepper.on('kt.stepper.next', function (stepper) {
			var currentStepIndex = stepper.getCurrentStepIndex() - 1;

			if (!_hasValidation || !_validations[currentStepIndex]) {
				stepper.goNext();
				(typeof KTUtil !== "undefined" && KTUtil.scrollTop) ? KTUtil.scrollTop() : window.scrollTo({ top: 0, behavior: "smooth" });
				return;
			}

			_validations[currentStepIndex].validate().then(function (status) {
				if (status == 'Valid') {
					stepper.goNext();
					(typeof KTUtil !== "undefined" && KTUtil.scrollTop) ? KTUtil.scrollTop() : window.scrollTo({ top: 0, behavior: "smooth" });
				} else {
					Swal.fire({
						text: "Sorry, looks like there are some errors detected, please try again.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light"
						}
					}).then(function () {
						(typeof KTUtil !== "undefined" && KTUtil.scrollTop) ? KTUtil.scrollTop() : window.scrollTo({ top: 0, behavior: "smooth" });
					});
				}
			});
		});

		// Étape précédente
		_stepper.on('kt.stepper.previous', function (stepper) {
			stepper.goPrevious();
			(typeof KTUtil !== "undefined" && KTUtil.scrollTop) ? KTUtil.scrollTop() : window.scrollTo({ top: 0, behavior: "smooth" });
		});

		// Soumission finale (dernière étape)
		_stepper.on('kt.stepper.submit', function () {
			// Place ici la logique de soumission finale du formulaire (ex: form.submit() ou requête AJAX)
			console.log('Form submitted');
		});

		// Changement d'étape
		_stepper.on('kt.stepper.changed', function (stepper) {
			updateActionButtons(stepper);
			(typeof KTUtil !== "undefined" && KTUtil.scrollTop) ? KTUtil.scrollTop() : window.scrollTo({ top: 0, behavior: "smooth" });
		});
	}

	var initValidation = function () {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

		// Step 1
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					firstname: {
						validators: {
							notEmpty: {
								message: 'First Name is required'
							}
						}
					},
					lastname: {
						validators: {
							notEmpty: {
								message: 'Last Name is required'
							}
						}
					},
					companyname: {
						validators: {
							notEmpty: {
								message: 'Company Name is required'
							}
						}
					},
					phone: {
						validators: {
							notEmpty: {
								message: 'Phone is required'
							},
							phone: {
								country: 'US',
								message: 'The value is not a valid US phone number. (e.g 5554443333)'
							}
						}
					},
					email: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					},
					companywebsite: {
						validators: {
							notEmpty: {
								message: 'Website URL is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 2
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					// Step 2
					communication: {
						validators: {
							choice: {
								min: 1,
								message: 'Please select at least 1 option'
							}
						}
					},
					language: {
						validators: {
							notEmpty: {
								message: 'Please select a language'
							}
						}
					},
					timezone: {
						validators: {
							notEmpty: {
								message: 'Please select a timezone'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 3
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					address1: {
						validators: {
							notEmpty: {
								message: 'Address is required'
							}
						}
					},
					postcode: {
						validators: {
							notEmpty: {
								message: 'Postcode is required'
							}
						}
					},
					city: {
						validators: {
							notEmpty: {
								message: 'City is required'
							}
						}
					},
					state: {
						validators: {
							notEmpty: {
								message: 'state is required'
							}
						}
					},
					country: {
						validators: {
							notEmpty: {
								message: 'Country is required'
							}
						}
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));
	}

	return {
		// public functions
		init: function () {
			_stepperEl = document.getElementById('kt_contact_add');
			_formEl = document.getElementById('kt_contact_add_form');

			_hasValidation = !(_formEl && _formEl.dataset && _formEl.dataset.wizardValidation === 'false');

			initStepper();
			if (_hasValidation) {
				initValidation();
			}
		}
	};
}();

jQuery(document).ready(function () {
	KTContactsAdd.init();
});
