import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    tennantList: (page, size, config) => {
        return HTTP.get(api_url + `/tennant?page=${page}&size=${size}`, config).then(result => result)
    },
    statusEdit: (data, config) => {
        return HTTP.post(api_url + '/tennant/update/status/' + data.id, data, config).then(result => result)
    },
    tennantUpdate: (data, config) => {
        return HTTP.post(api_url + '/tennant/update', data, config).then(result => result)
    },
    tennantAdd: (data, config) => {
        return HTTP.post(api_url + '/tennant/create', data, config).then(result => result)
    },
    tennantDetail: (id, config) => {
        return HTTP.get(api_url + `/tennant/${id}`, config).then(result => result)
    },
    tennantDelete: (id, config) => {
        return HTTP.get(api_url + `/tennant/delete/${id}`, config).then(result => result)
    },
}
