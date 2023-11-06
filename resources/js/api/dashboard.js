import HTTP from 'axios';
let api_url = process.env.API_URL
export default {
    getList: (config) => {
        return HTTP.get( api_url+ '/banner', config).then(result => result)
    },
    getDetail: (id, config) => {
        return HTTP.get( api_url+ `/banner/${id}`, config).then(result => result)
    },
    create_banner: (data, config) => {
        return HTTP.post( api_url+ '/banner/create', data, config).then(result => result)
    },
    edit_banner: (data, config) => {
        return HTTP.post( api_url+ '/banner/update', data, config).then(result => result)
    },
    bannerDelete: (id, config) => {
        return HTTP.get( api_url+ '/banner/delete/'+id, config).then(result => result)
    },
}
