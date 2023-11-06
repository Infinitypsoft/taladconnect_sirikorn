import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    buildingList: (config) => {
        return HTTP.get(api_url + `/site`, config).then(result => result)
    },
    buildingAdd: (data, config) => {
        return HTTP.post(api_url + `/site/create`, data, config).then(result => result)
    },
    siteList: (id, config) => {
        return HTTP.get(api_url + `/site/${id}`, config).then(result => result)
    }
}
