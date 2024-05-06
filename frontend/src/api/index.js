import constants from "@/constant";
import axios from "axios";
import Auth from '@/auth/index';

class ApiCalls {
    async get(endpoints) {
        return await axios.get(constants.BASE_URL + endpoints, {
            headers: {
                'Authorization': `Bearer ${Auth.token}`,
                'Access-Control-Allow-Origin': '*',
                'Accept': 'application/json',
            }
        })
    }

    async post(endpoints, data) {
        return await axios.post(constants.BASE_URL + endpoints, data, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${Auth.token}`
            }
        }
    );
    }
}

export default new ApiCalls();