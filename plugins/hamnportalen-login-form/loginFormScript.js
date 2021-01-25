//Change input type from "text" to "password" in  login form.
const updateInputType = () => {
    const loginInputField = document.querySelector("#wpforms-202-field_4")
    
    if(loginInputField) {
        loginInputField.type = 'password';
    }
}

updateInputType();
