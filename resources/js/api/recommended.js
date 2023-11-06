import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    getList: (config) => {
        return HTTP.get(api_url + `/store/recommen/list`, config).then(result => result)
    },
    getListSelect: (config) => {
        return HTTP.get(api_url + `/store/list/select/box`, config).then(result => result)
    },
    recommendedUpdate: (data, config) => {
        return HTTP.post(api_url + `/store/recommen/update`, data, config).then(result => result)
    },
}
