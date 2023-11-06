import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    authEditSetting: (data, config) => {
        return HTTP.post(api_url + '/setting/update', data, config).then(result => result)
    },
    settingList: (config) => {
        return HTTP.get(api_url + `/setting`, config).then(result => result)
    },
    authEditSEO: (data, config) => {
        return HTTP.post(api_url + '/seo/update', data, config).then(result => result)
    },
    seoList: (config) => {
        return HTTP.get(api_url + `/seo`, config).then(result => result)
    },

}
