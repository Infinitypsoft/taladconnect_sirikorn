import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    galleryList: (config) => {
        return HTTP.get(api_url + `/gallery`, config).then(result => result)
    },
    galleryUpdate: (data, config) => {
        return HTTP.post(api_url + '/gallery/update', data, config).then(result => result)
    },
}
