import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    adminList: (page, size, config) => {
        return HTTP.get(api_url + `/admin?page=${page}&size=${size}`, config).then(result => result)
    },
    statusEdit: (data, config) => {
        return HTTP.post(api_url + '/admin/update/status/' + data.id, data, config).then(result => result)
    },
    adminUpdate: (data, config) => {
        return HTTP.post(api_url + '/admin/update', data, config).then(result => result)
    },
    adminAdd: (data, config) => {
        return HTTP.post(api_url + '/admin/create', data, config).then(result => result)
    },
    adminDetail: (id, config) => {
        return HTTP.get(api_url + `/admin/detail/${id}`, config).then(result => result)
    },
    adminDelete: (id, config) => {
        return HTTP.get(api_url + `/admin/delete/${id}`, config).then(result => result)
    },
}
