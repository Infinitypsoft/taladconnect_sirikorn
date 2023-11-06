import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    transferList: (page, size, config) => {
        return HTTP.get(api_url + `/transfer?page=${page}&size=${size}`, config).then(result => result)
    },
    statusEdit: (data, config) => {
        return HTTP.post(api_url + '/transfer/update/status/' + data.id, data, config).then(result => result)
    },
    transferUpdate: (data, config) => {
        return HTTP.post(api_url + '/transfer/update', data, config).then(result => result)
    },
    transferAdd: (data, config) => {
        return HTTP.post(api_url + '/transfer/create', data, config).then(result => result)
    },
    transferDetail: (id, config) => {
        return HTTP.get(api_url + `/transfer/${id}`, config).then(result => result)
    },
    transferDelete: (id, config) => {
        return HTTP.get(api_url + `/transfer/delete/${id}`, config).then(result => result)
    },
}
