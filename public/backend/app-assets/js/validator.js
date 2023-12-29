function Validator(formSelector) {

    var _this = this;
    // Format: key = name && value = attribute
    var formRules = {};

    function getParent (element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    /**
     *  1. Khi có lỗi => trả ra các message lỗi
     *  2. Khi hợp lệ => Không trả ra cái gì cả (undefined)
     */

    var validatorRules = {
        required: function (value) {
            return value ? undefined : '* Vui lòng nhập trường này'
        },
        email: function (value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
            return regex.test(value) ? undefined : '* Trường này phải là email'
        },
        min: function (min) {
            // return value  ? undefined : 'Vui lòng nhập trường này'
            return function (value) {
                return value.length >= min ? undefined : `* Vui lòng nhập tối thiểu ${min} kí tự`
            }
        },
    }

    var formElement = document.querySelector(formSelector);

    // Chỉ xử lý khi có element trong DOM
    if (formElement) {

        var inputs = formElement.querySelectorAll('[name][rules]');
        // console.log(inputs);
        for (var input of inputs) {
            var rules = input.getAttribute('rules').split('|');

            rules.forEach((rule) => {

                var ruleInfo;
                var isRuleHasValue = rule.includes(':');

                if (isRuleHasValue) {
                    ruleInfo = rule.split(':');
                    var rule = ruleInfo[0];
                }

                var ruleFunc = validatorRules[rule];

                if (isRuleHasValue) {
                    ruleFunc = ruleFunc(ruleInfo[1])
                }

                if (Array.isArray(formRules[input.name])) {
                    formRules[input.name].push(ruleFunc);
                } else {
                    formRules[input.name] = [ruleFunc]
                }
            })

            // Lắng nghe sự kiện để validate (blur, change)
            input.onblur = handleValidate;
            input.oninput = handleClearError;
        }

        // Hàm thực hiện Validate
        function handleValidate (e) {
            var rules = formRules[e.target.name];
            var errorMessage;

            for (rule of rules) {
                errorMessage = rule(e.target.value);
                if (errorMessage) break;
            }

            // Nếu có lỗi thì hiển thị lỗi ra UI
            if (errorMessage) {
                var formGroup = getParent(e.target, '.input-field');

                if (formGroup) {
                    formGroup.classList.add('invalid');

                    var formMessage = formGroup.querySelector('.input-message');
                    if (formMessage) {
                        formMessage.innerText = errorMessage;
                    }
                }
            }

            return !errorMessage;
        }

        function handleClearError (e) {
            var formGroup = getParent(e.target, '.input-field');
            if (formGroup.classList.contains('invalid')) {
                formGroup.classList.remove('invalid');

                var formMessage = formGroup.querySelector('.input-message');
                if (formMessage) {
                    formMessage.innerText = '';
                }
            }
        }
    }

    // Xử lý hành vi submit form
    formElement.onsubmit = function (e) {
        e.preventDefault();

        var inputs = formElement.querySelectorAll('[name][rules]');

        var isValid = true;

        for (var input of inputs) {
           if (!handleValidate({ target: input })) {
                isValid = false;
           }
        }

        // Khi không có lôi submit form
        if (isValid) {
            if (typeof _this.onSubmit === 'function') {
                var enableInputs = formElement.querySelectorAll('[name]:not([disabled])');
                // Biến 1 chuỗi, NodeList thành 1 mảng
                var formValues = Array.from(enableInputs).reduce((values, input) => {
                    switch (input.type) {
                        case 'checkbox':
                            if (input.matches(':checked')) {
                                if (!Array.isArray(values[input.name])) {
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value);
                            } else if (!values[input.name]) {
                                values[input.name] = '';
                            }
                            break;
                        case 'radio':
                            if (input.matches(':checked')) {
                                values[input.name] = input.value;
                            } else if (!values[input.name]) {
                                values[input.name] = '';
                            }
                            break;
                        case 'file':
                            values[input.name] = input.files;
                            break;
                        default:
                            values[input.name] = input.value;
                    }
                    return values;
                }, {})
                _this.onSubmit(formValues);
            } else {
                formElement.submit();
            }
        }
    }
    // console.log(formRules);
}


