import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    blockList: (config) => {
        return HTTP.get(api_url + `/block`, config).then(result => result)
    },
    statusEdit: (data, config) => {
        return HTTP.post(api_url + '/block/update/status/' + data.id, data, config).then(result => result)
    },
    blockUpdate: (data, config) => {
        return HTTP.post(api_url + '/block/update', data, config).then(result => result)
    },
    blockAdd: (data, config) => {
        return HTTP.post(api_url + '/block/create', data, config).then(result => result)
    },
    blockDetail: (id, config) => {
        return HTTP.get(api_url + `/block/${id}`, config).then(result => result)
    },
    blockDelete: (id, config) => {
        return HTTP.get(api_url + `/block/delete/${id}`, config).then(result => result)
    },
    blockDeleteAll: (data, config) => {
        return HTTP.post(api_url + `/block/delete_all`, data , config).then(result => result)
    },

    
}
