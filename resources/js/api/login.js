
import HTTP from 'axios';
export default {
    authLogin: (data) => {
        return HTTP.post(process.env.API_URL + '/login', data).then(response => response)
    },
    logOut: (config) => {
        return HTTP.get(process.env.API_URL + '/logout/admin', config).then(response => response)
    },
    profile: (config) => {
        return HTTP.get(process.env.API_URL + '/profile/admin', config).then(response => response)
    }
}
