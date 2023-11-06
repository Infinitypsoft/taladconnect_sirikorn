import HTTP from 'axios';
let api_url = process.env.API_URL

export default {
    contract_blockList: (type, page, size, config) => {
        return HTTP.get(api_url + `/contract/block?type=${type}&page=${page}&size=${size}`, config).then(result => result)
    },
    statusEdit: (id, config) => {
        return HTTP.get(api_url + '/contract/block/confirm/' + id, config).then(result => result)
    },
    contract_blockUpdate: (data, config) => {
        return HTTP.post(api_url + '/contract/block/update', data, config).then(result => result)
    },
    contract_blockUploadSlip: (data, config) => {
        return HTTP.post(api_url + '/contract/block/upload/slip', data, config).then(result => result)
    },
    contract_blockAdd: (data, config) => {
        return HTTP.post(api_url + '/contract/block/create', data, config).then(result => result)
    },
    contract_blockDetail: (id, config) => {
        return HTTP.get(api_url + `/contract/block/${id}`, config).then(result => result)
    },
    contract_blockDelete: (id, config) => {
        return HTTP.get(api_url + `/contract/block/delete/${id}`, config).then(result => result)
    },
    contract_blockCheckBuyed: (id, config) => {
        return HTTP.get(api_url + `/contract/block/check/buyed/${id}`, config).then(result => result)
    },
}
