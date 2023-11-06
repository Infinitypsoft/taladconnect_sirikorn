import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    stallList: (page, size, config) => {
        return HTTP.get(api_url + `/stall?page=${page}&size=${size}`, config).then(result => result)
    },
    statusEdit: (data, config) => {
        return HTTP.post(api_url + '/stall/update/status/' + data.id, data, config).then(result => result)
    },
    stallUpdate: (data, config) => {
        return HTTP.post(api_url + '/stall/update', data, config).then(result => result)
    },
    stallAdd: (data, config) => {
        return HTTP.post(api_url + '/stall/create', data, config).then(result => result)
    },
    stallDetail: (id, config) => {
        return HTTP.get(api_url + `/stall/${id}`, config).then(result => result)
    },
    stallDelete: (id, config) => {
        return HTTP.get(api_url + `/stall/delete/${id}`, config).then(result => result)
    },
}
