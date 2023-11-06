import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    contractList: (config) => {
        return HTTP.get(api_url + `/contract`, config).then(result => result)
    },
    contractUpdate: (data, config) => {
        return HTTP.post(api_url + '/contract/update', data, config).then(result => result)
    },
    contractDetail: (id, config) => {
        return HTTP.get(api_url + `/contact/detail/${id}`, config).then(result => result)
    },
}
