
const mutations = {
    logInSuccess(state, data) {
        state.access_token = data.access_token
    },
    logOutSuccess(state) {
        state.access_token = null
    },
    Add_User(state,data){
        state.access_token = data.access_token
    },
    image_th(state,image){
        state.image_th.push(image)
    },
    Add_bill_code(state,data){
        state.bill_code = data.bill_code
    },
}
export default mutations
