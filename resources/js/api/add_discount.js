import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    authAdddiscount: (data, config) => {
        return HTTP.post( api_url+ '/discount/create', data, config).then(result => result)
    },
    authEditdiscount: (data, config) => {
        return HTTP.post( api_url+ '/discount/update', data, config).then(result => result)
    },
    discountList: (page, size, search, config) => {
        return HTTP.get( api_url+ `/discount?page=${page}&size=${size}&search=${search}`, config).then(result => result)
    },
    discountDetailEdit: (id,  config) => {
        return HTTP.get( api_url+ `/discount/${id}`, config).then(result => result)
    },
    discountDelete: (id,  config) => {
        return HTTP.get( api_url+ `/discount/delete/${id}`, config).then(result => result)
    },
    changeStatus: (id, status,  config) => {
        return HTTP.get( api_url+ `/discount/status/${id}?status=${status}`, config).then(result => result)
    },
}
