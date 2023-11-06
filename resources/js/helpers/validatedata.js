async function validateEmail(evt) {
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if (((charCode >= 64 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || (charCode >= 48 && charCode <= 57) || charCode === 46 || charCode === 95)) {
        return true
    }
    else {
        evt.preventDefault();
    }
}

function isDay(evt, number){
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
        evt.preventDefault();
    }
    // restrict to length of number
    if (number != null && number.length > 1) {
        evt.preventDefault();
    }
    else {
        return true
    }
}

function isNumber(evt, number){
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
        evt.preventDefault();
    }
    else {
        return true
    }
}

function isAge(evt, number){
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
        evt.preventDefault();
    }
    // restrict to length of number
    if (number != null && number.length > 1) {
        evt.preventDefault();
    }
    else {
        return true
    }
}

function isTelephone(evt, number) {
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
        evt.preventDefault();
    }
    // restrict to length of number
    if (number != null && number.length > 9) {
        evt.preventDefault();
    }
    else {
        return true
    }
}
function isYear(evt, number) {
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
        evt.preventDefault();
    }
    // restrict to length of number
    if (number != null && number.length > 3) {
        evt.preventDefault();
    }
    else {
        return true
    }
}
function isIDCard(evt, number) {
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
        evt.preventDefault();
    }
    // restrict to length of number
    if (number != null && number.length > 12) {
        evt.preventDefault();
    }
    else {
        return true
    }
}

// function isDecimalInput(evt, value) {
//     evt = (evt) ? evt : window.event;
//     let charCode = (evt.which) ? evt.which : evt.keyCode;

//     if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode != 46) {
//         evt.preventDefault();
//     }
//     // ห้ามกรอก . ก่อน
//     if (value != null && value.split('.').length === 2 && charCode === 46) {
//         evt.preventDefault();
//     }
//     // ห้ามกรอก . ซ้ำ
//     if (value != null && value.length < 1 && charCode === 46) {
//         evt.preventDefault();
//     }
//     else {
//         return true
//     }
// }

function isDecimalInput(evt, value) {
    evt = evt || window.event;
    let charCode = evt.which || evt.keyCode;

    // Allow digits (0-9), a single decimal point (.), and backspace (8)
    if (
        (charCode >= 48 && charCode <= 57) || // Digits 0-9
        (charCode === 46 && value.indexOf('.') === -1) || // Decimal point (.) not already entered
        charCode === 8 // Backspace key
    ) {
        return true;
    }

    evt.preventDefault();
    return false;
}

function onlyForCurrency(evt, number) {
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();
    }
    // restrict to 2 decimal places
    if(number !== null && number.indexOf(".") > -1 && (number.split('.')[1].length >= 2)){
        evt.preventDefault();
    }
    else {
        return true
    }
}

async function onPaste(evt) {
    evt.preventDefault()
}

export {
    validateEmail,
    onPaste,
    isTelephone,
    isNumber,
    isIDCard,
    isDecimalInput,
    isDay,
    isAge,
    isYear,
    onlyForCurrency,
}