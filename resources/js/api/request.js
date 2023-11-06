import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    requestList: (page, size, search, config) => {
        return HTTP.get(api_url + `/request?page=${page}&size=${size}&search=${search}`, config).then(result => result)
    },
    requestUpdate: (data, config) => {
        return HTTP.post(api_url + '/request/update', data, config).then(result => result)
    },
    requestAdd: (data, config) => {
        return HTTP.post(api_url + '/request/create', data, config).then(result => result)
    },
    requestDetail: (id, config) => {
        return HTTP.get(api_url + `/request/detail/${id}`, config).then(result => result)
    },
    requestDelete: (id, config) => {
        return HTTP.get(api_url + `/request/delete/${id}`, config).then(result => result)
    },
}
