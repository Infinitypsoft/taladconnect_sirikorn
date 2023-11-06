import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    getList: (id, config) => {
        return HTTP.get(api_url + `/electric/tennant/list/${id}`, config).then(result => result)
    },
    summary_confirm: (id, config) => {
        return HTTP.get(api_url + `/electric/tennant/create/${id}`, config).then(result => result)
    },
    updateStatus: (id, config) => {
        return HTTP.get(api_url + `/electric/tennant/status/${id}`, config).then(result => result)
    },
    getDetailById: (id, config) => {
        return HTTP.get(api_url + `/electric/tennant/detail/${id}`, config).then(result => result)
    },
    // create: (data, config) => {
    //     return HTTP.post(api_url + `/electric/bill/create`, data, config).then(result => result)
    // },
    // getDetailById: (id, config) => {
    //     return HTTP.get(api_url + `/electric/bill/detail/${id}`, config).then(result => result)
    // },
    // getDetailSaveMeterById: (id, config) => {
    //     return HTTP.get(api_url + `/electric/bill/save/meter/${id}`, config).then(result => result)
    // },
    // updateMeter: (id, data, config) => {
    //     return HTTP.post(api_url + `/electric/update/${id}`, data, config).then(result => result)
    // },
}
