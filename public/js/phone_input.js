const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: "mx",
        preferredCountries: ["us", "mx"],
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });



    function process(event) {
        event.preventDefault();


        const phoneField = document.getElementById("phone_international");
        phoneField.value = phoneInput.getNumber();


        document.getElementById('contact-form').submit();
    }