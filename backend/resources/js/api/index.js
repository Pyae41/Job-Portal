import axios from "axios";
import constants from '../constants/index.js';
import Auth from '../auth/index.js';


class ApiCalls {

    async get(endpoint) {
        return await axios.get(constants.BASE_URL + endpoint, {
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${Auth.token}`
            }
        });
    }
    async getById(endpoint) {
        let response = await axios.get(constants.BASE_URL + endpoint, {
            headers: {
                'Authorization': `Bearer ${Auth.token}`
            }
        })
            .then(response => response.data)
            .catch(error => {
                if (error.response.status == 401) {
                    Auth.logout();

                    alert('Session timeout');

                    window.location.href = '/login';
                }
            });

        return response;
    }
    post(endpoint, data) {
        return axios.post(constants.BASE_URL + endpoint, data, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${Auth.token}`
            }
        });
    }

    update(endpoint, data) {
        return axios.post(constants.BASE_URL + endpoint, data, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${Auth.token}`
            },
            params: {
                _method: 'put'
            }
        });
    }

    async delete(endpoint) {
        return await axios.delete(constants.BASE_URL + endpoint, {
            headers: {
                'Authorization': `Bearer ${Auth.token}`
            }
        });
    }
}

export default new ApiCalls();
