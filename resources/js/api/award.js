import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    awardList: (page, size, config) => {
        return HTTP.get(api_url + `/award?page=${page}&size=${size}`, config).then(result => result)
    },
    statusEdit: (data, config) => {
        return HTTP.post(api_url + '/award/update/status/' + data.id, data, config).then(result => result)
    },
    awardUpdate: (data, config) => {
        return HTTP.post(api_url + '/award/update', data, config).then(result => result)
    },
    awardAdd: (data, config) => {
        return HTTP.post(api_url + '/award/create', data, config).then(result => result)
    },
    awardDetail: (id, config) => {
        return HTTP.get(api_url + `/award/${id}`, config).then(result => result)
    },
    awardDelete: (id, config) => {
        return HTTP.get(api_url + `/award/delete/${id}`, config).then(result => result)
    },
}
