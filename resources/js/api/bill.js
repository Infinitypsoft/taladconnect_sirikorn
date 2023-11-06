import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    billList: (page, size, config) => {
        return HTTP.get(api_url + `/bill?page=${page}&size=${size}`, config).then(result => result)
    },
    billGetId: (config) => {
        return HTTP.get(api_url + `/bill/bill_id`, config).then(result => result)
    },
    statusEdit: (data, config) => {
        return HTTP.post(api_url + '/bill/update/status/' + data.id, data, config).then(result => result)
    },
    billUpdate: (data, config) => {
        return HTTP.post(api_url + '/bill/update', data, config).then(result => result)
    },
    billAdd: (data, config) => {
        return HTTP.post(api_url + '/bill/create', data, config).then(result => result)
    },
    billDetail: (id, config) => {
        return HTTP.get(api_url + `/bill/${id}`, config).then(result => result)
    },
    billDelete: (id, config) => {
        return HTTP.get(api_url + `/bill/delete/${id}`, config).then(result => result)
    },
}
