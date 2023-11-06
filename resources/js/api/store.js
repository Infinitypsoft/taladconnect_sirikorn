import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    create: (data, config) => {
        return HTTP.post(api_url + `/store/create`, data, config).then(result => result)
    },
    updateEng: (data, config) => {
        return HTTP.post(api_url + `/store/update`, data, config).then(result => result)
    },
    getSelectbox: (id, config) => {
        return HTTP.get(api_url + `/block/list/to/create/store?tennant_member_id=${id}`, config).then(result => result)
    },
    getStoreById: (id, config) => {
        return HTTP.get(api_url + `/store/${id}`, config).then(result => result)
    },
    getStoreList: (id, config) => {
        return HTTP.get(api_url + `/store/list/${id}`, config).then(result => result)
    },
}
