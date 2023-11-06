import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    getList: (page, search, site_id, config) => {
        return HTTP.get(api_url + `/water?page=${page}&search=${search}&site_id=${site_id}`, config).then(result => result)
    },
    update: (data, config) => {
        return HTTP.post(api_url + `/water/startdate/update`, data, config).then(result => result)
    },
}
