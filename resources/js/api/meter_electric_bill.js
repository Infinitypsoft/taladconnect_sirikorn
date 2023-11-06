import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    getList: (page, search, config) => {
        return HTTP.get(api_url + `/electric/bill/list?page=${page}&search=${search}`, config).then(result => result)
    },
    update: (data, config) => {
        return HTTP.post(api_url + `/electric/startdate/update`, data, config).then(result => result)
    },
    checkBillCode: (config) => {
        return HTTP.get(api_url + `/electric/bill/check/code`, config).then(result => result)
    },
    create: (data, config) => {
        return HTTP.post(api_url + `/electric/bill/create`, data, config).then(result => result)
    },
    getDetailById: (id, config) => {
        return HTTP.get(api_url + `/electric/bill/detail/${id}`, config).then(result => result)
    },
    delete: (id, config) => {
        return HTTP.get(api_url + `/electric/delete/${id}`, config).then(result => result)
    },
    getDetailSaveMeterById: (id, bill_id, config) => {
        return HTTP.get(api_url + `/electric/bill/save/meter/${id}?bill_id=${bill_id}`, config).then(result => result)
    },
    updateMeter: (id, data, config) => {
        return HTTP.post(api_url + `/electric/update/${id}`, data, config).then(result => result)
    },
    updateStatus: (id, config) => {
        return HTTP.get(api_url + `/electric/bill/status/${id}`, config).then(result => result)
    },
    updateBill: (data, config) => {
        return HTTP.post(api_url + `/electric/bill/update`, data, config).then(result => result)
    },
}
