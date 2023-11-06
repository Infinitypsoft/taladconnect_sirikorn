import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    getList: (id, config) => {
        return HTTP.get(api_url + `/water/tennant/list/${id}`, config).then(result => result)
    },
    summary_confirm: (id, config) => {
        return HTTP.get(api_url + `/water/tennant/create/${id}`, config).then(result => result)
    },
    updateStatus: (id, config) => {
        return HTTP.get(api_url + `/water/tennant/status/${id}`, config).then(result => result)
    },
    getDetailById: (id, config) => {
        return HTTP.get(api_url + `/water/tennant/detail/${id}`, config).then(result => result)
    },
    // create: (data, config) => {
    //     return HTTP.post(api_url + `/water/bill/create`, data, config).then(result => result)
    // },
    // getDetailById: (id, config) => {
    //     return HTTP.get(api_url + `/water/bill/detail/${id}`, config).then(result => result)
    // },
    // getDetailSaveMeterById: (id, config) => {
    //     return HTTP.get(api_url + `/water/bill/save/meter/${id}`, config).then(result => result)
    // },
    // updateMeter: (id, data, config) => {
    //     return HTTP.post(api_url + `/water/update/${id}`, data, config).then(result => result)
    // },
}
