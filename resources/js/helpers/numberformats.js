async function isNumberOnly(evt) {
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
        evt.preventDefault();
    } else {
        return true;
    }
}
function formatNumber(value) {
    if (value !== '' && value !== null && value !== 'undefined' && value !== 0) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }
    else if (value === 0) {
        return 0
    }
    else {
        return 0
    }
}


function formatPrice(value) {
    if (value !== '' && value !== null && value !== 'undefined') {
        let val = (value / 1).toFixed(2).replace(',', '.')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }
    else {
        return 0.00
    }
}
export {
    isNumberOnly,
    formatNumber,
    formatPrice,
}