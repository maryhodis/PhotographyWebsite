// JavaScript Document
$(document).ready(function() {
    $('#autoWidth').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        } 
    });  
  });

document.addEventListener("DOMContentLoaded", function() {
    fields.firstName = document.getElementById('firstName');
    fields.lastName = document.getElementById('lastName');
    fields.email = document.getElementById('email');
    fields.address = document.getElementById('address');
    fields.country = document.getElementById('country');
    fields.password = document.getElementById('password');
    fields.passwordCheck = document.getElementById('passwordCheck');
    fields.question = document.getElementById('question');
});
function isNotEmpty(value) {
    if (value == null || typeof value == 'undefined' ) return false;
    return (value.length > 0);
   }
function isNumber(num) {
return (num.length > 0) && !isNaN(num);
}

function isPasswordValid(password) {
    if (password.length > 5) {
    return true;
    }
    return false
   }
function fieldValidation(field, validationFunction) {
    if (field == null) return false;

    let isFieldValid = validationFunction(field.value)
    if (!isFieldValid) {
        field.className = 'placeholderRed';
    } else {
        field.className = '';
    }

    return isFieldValid;
}
function isValid() {
    var valid = true;
    
    valid &= fieldValidation(fields.firstName, isNotEmpty);
    valid &= fieldValidation(fields.lastName, isNotEmpty);
    valid &= fieldValidation(fields.address, isNotEmpty);
    valid &= fieldValidation(fields.country, isNotEmpty);
    valid &= fieldValidation(fields.email, isEmail);
    valid &= fieldValidation(fields.password, isPasswordValid);
    valid &= fieldValidation(fields.passwordCheck, isPasswordValid);
    valid &= fieldValidation(fields.question, isNotEmpty);
    valid &= arePasswordsEqual();
   
    return valid;
}
function arePasswordsEqual() {
    if (fields.password.value == fields.passwordCheck.value) {
        field.password.className = 'placeholderRed';
        field.passwordCheck.className = 'placeholderRed';
    return true;
    }
    return false;
}
class User {
    constructor(firstName, lastName, address, country, email, question) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.address = address;
    this.country = country;
    this.email = email;
    this.question = question;
    }
}
function sendContact(){
    if (isValid()) {
        let usr = new User(firstName.value, lastName.value, address.value, country.value, email.value);
        
        alert('${usr.firstName} thanks for registrering.')
    } else {
        alert("There was an error.")
    }
}