import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    contentList: (page, size, config) => {
        return HTTP.get(api_url + `/content?page=${page}&size=${size}`, config).then(result => result)
    },
    statusEdit: (data, config) => {
        return HTTP.post(api_url + '/content/update/status/' + data.id, data, config).then(result => result)
    },
    contentUpdate: (data, config) => {
        return HTTP.post(api_url + '/content/update', data, config).then(result => result)
    },
    contentAdd: (data, config) => {
        return HTTP.post(api_url + '/content/create', data, config).then(result => result)
    },
    contentDetail: (id, config) => {
        return HTTP.get(api_url + `/content/detail/${id}`, config).then(result => result)
    },
    contentDelete: (id, config) => {
        return HTTP.get(api_url + `/content/delete/${id}`, config).then(result => result)
    },
}
