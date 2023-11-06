import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    reviewList: (page, size, review_type, config) => {
        return HTTP.get(api_url + `/review?page=${page}&size=${size}&review_type=${review_type}`, config).then(result => result)
    },
    reviewUpdate: (data, config) => {
        return HTTP.post(api_url + '/review/update', data, config).then(result => result)
    },
    reviewAdd: (data, config) => {
        return HTTP.post(api_url + '/review/create', data, config).then(result => result)
    },
    reviewDetail: (id, config) => {
        return HTTP.get(api_url + `/review/detail/${id}`, config).then(result => result)
    },
    reviewDelete: (id, config) => {
        return HTTP.get(api_url + `/review/delete/${id}`, config).then(result => result)
    },
}
