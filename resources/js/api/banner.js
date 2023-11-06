import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    bannerList: (page, size, config) => {
        return HTTP.get(api_url + `/banner?page=${page}&size=${size}`, config).then(result => result)
    },
    statusEdit: (data, config) => {
        return HTTP.post(api_url + '/banner/update/status/' + data.id, data, config).then(result => result)
    },
    bannerUpdate: (data, config) => {
        return HTTP.post(api_url + '/banner/update', data, config).then(result => result)
    },
    bannerAdd: (data, config) => {
        return HTTP.post(api_url + '/banner/create', data, config).then(result => result)
    },
    bannerDetail: (id, config) => {
        return HTTP.get(api_url + `/banner/${id}`, config).then(result => result)
    },
    bannerDelete: (id, config) => {
        return HTTP.get(api_url + `/banner/delete/${id}`, config).then(result => result)
    },
}
