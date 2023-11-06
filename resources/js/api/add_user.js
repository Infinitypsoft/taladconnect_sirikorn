import HTTP from 'axios';
let api_url = process.env.API_URL
export default {
    authAddAdmin: (data, config) => {
        return HTTP.post( api_url+ '/admin/create', data, config).then(result => result)
    },
    authEditAdmin: (data, config) => {
        return HTTP.post( api_url+ '/admin/update', data, config).then(result => result)
    },
    adminList: (page, size, search,  config) => {
        return HTTP.get( api_url+ `/admin?page=${page}&size=${size}&search=${search}`, config).then(result => result)
    },
    adminDetail: (id,  config) => {
        return HTTP.get( api_url+ `/admin/detail/${id}`, config).then(result => result)
    },
    adminDetailEdit: (id,  config) => {
        return HTTP.get( api_url+ `/admin/${id}`, config).then(result => result)
    },
    adminDelete: (id,  config) => {
        return HTTP.get( api_url+ `/admin/delete/${id}`, config).then(result => result)
    },
    changeStatus: (id, status,  config) => {
        return HTTP.get( api_url+ `/admin/status/${id}?status=${status}`, config).then(result => result)
    },

    ///user
    AddUser: (data, config) => {
        return HTTP.post( api_url+ '/user/create', data, config).then(result => result)
    },
    EditUser: (data, config) => {
        return HTTP.post( api_url+ '/user/update/by/admin', data, config).then(result => result)
    },
    userList: (page, size, search,  config) => {
        return HTTP.get( api_url+ `/user?role=&page=${page}&size=${size}&search=${search}`, config).then(result => result)
    },
    userDetailEdit: (id,  config) => {
        return HTTP.get( api_url+ `/user/${id}`, config).then(result => result)
    },
    userDetail: (id,  config) => {
        return HTTP.get( api_url+ `/user/detail/${id}`, config).then(result => result)
    },
    addCoinUser: (data, config) => {
        return HTTP.post( api_url+ '/user/add/coin/by/admin', data, config).then(result => result)
    },
    userDelete: (id,  config) => {
        return HTTP.get( api_url+ `/user/delete/${id}`, config).then(result => result)
    },
}
