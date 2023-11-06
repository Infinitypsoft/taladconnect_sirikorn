import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    contactList: (page, size, config) => {
        return HTTP.get(api_url + `/contact?page=${page}&size=${size}`, config).then(result => result)
    },
    statusEdit: (data, config) => {
        return HTTP.post(api_url + '/contact/update/status/' + data.id, data, config).then(result => result)
    },
    contactUpdate: (data, config) => {
        return HTTP.post(api_url + '/contact/update', data, config).then(result => result)
    },
    contactAdd: (data, config) => {
        return HTTP.post(api_url + '/contact/create', data, config).then(result => result)
    },
    contactDetail: (id, config) => {
        return HTTP.get(api_url + `/contact/detail/${id}`, config).then(result => result)
    },
    contactDelete: (id, config) => {
        return HTTP.get(api_url + `/contact/delete/${id}`, config).then(result => result)
    },
}
