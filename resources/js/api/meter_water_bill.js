import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    getList: (page, search, config) => {
        return HTTP.get(api_url + `/water/bill/list?page=${page}&search=${search}`, config).then(result => result)
    },
    update: (data, config) => {
        return HTTP.post(api_url + `/water/startdate/update`, data, config).then(result => result)
    },
    checkBillCode: (config) => {
        return HTTP.get(api_url + `/water/bill/check/code`, config).then(result => result)
    },
    create: (data, config) => {
        return HTTP.post(api_url + `/water/bill/create`, data, config).then(result => result)
    },
    delete: (id, config) => {
        return HTTP.get(api_url + `/water/delete/${id}`, config).then(result => result)
    },
    getDetailById: (id, config) => {
        return HTTP.get(api_url + `/water/bill/detail/${id}`, config).then(result => result)
    },
    getDetailSaveMeterById: (id, bill_id, config) => {
        return HTTP.get(api_url + `/water/bill/save/meter/${id}?bill_id=${bill_id}`, config).then(result => result)
    },
    updateMeter: (id, data, config) => {
        return HTTP.post(api_url + `/water/update/${id}`, data, config).then(result => result)
    },
    updateStatus: (id, config) => {
        return HTTP.get(api_url + `/water/bill/status/${id}`, config).then(result => result)
    },
    updateBill: (data, config) => {
        return HTTP.post(api_url + `/water/bill/update`, data, config).then(result => result)
    },
}
