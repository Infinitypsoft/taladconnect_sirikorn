function base64Encode(value){
    return btoa(value)
}

function base64Decode(value){
    return atob(value)
}
export {
    base64Encode,
    base64Decode,
}