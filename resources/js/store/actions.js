import axios from 'axios';

export default {
    loginAction: async ({commit}, {email, password}) => {
        try{
            const response = await axios({
                'method': 'post',
                'url': '/api/v1/users/auth/login',
                data: {
                    email: email,
                    password: password
                }
            });

            if (response.data.message === 'success') {
                localStorage.setItem('token', response.data.data.access_token);
                const payload = {
                    token: response.data.data.access_token,
                    guard: 'user'
                }
                await commit('authSuccess', payload );
            }
        }
        catch (error){
            commit('authError')
        }
    },

    companyLoginAction: async ({commit}, {email, password}) => {
        try{
            const response = await axios({
                'method': 'post',
                'url': '/api/v1/companies/auth/login',
                data: {
                    email: email,
                    password: password
                }
            });

            if (response.data.message === 'success') {
                localStorage.setItem('token', response.data.data.access_token);
                const payload = {
                    token: response.data.data.access_token,
                    guard: 'company'
                }
                await commit('authSuccess', payload );
            }
        }
        catch (error){
            commit('authError')
        }
    },

    employeeLoginAction: async ({commit}, {email, password}) => {
        try{
            const response = await axios({
                'method': 'post',
                'url': '/api/v1/employees/auth/login',
                data: {
                    email: email,
                    password: password
                }
            });

            if (response.data.message === 'success') {
                localStorage.setItem('token', response.data.data.access_token);
                const payload = {
                    token: response.data.data.access_token,
                    guard: 'employee'
                }
                await commit('authSuccess', payload );
            }
        }
        catch (error){
            commit('authError')
        }
    },

    logOutAction: async ({commit}) => {
        try {
            const token = localStorage.getItem('token');
            const response = await axios({
                'method': 'get',
                'url': '/api/v1/logout',
                headers: { Authorization: `Bearer ${token}` }
            });

            if (response.data.message === 'success') {
                await commit('authLogOut');
                localStorage.removeItem('token');
            }
        }
        catch (error) {
            commit('authError')
        }
    },

    getCompanyAction: async ({commit}) => {
        try {
            const token = localStorage.getItem('token');
            const response = await axios({
                'method': 'get',
                'url': '/api/v1/companies',
                headers: { Authorization: `Bearer ${token}` }
            });

            if (response.data.message === 'success') {
                await commit('setCompany', response.data.data);
            }
        }
        catch (error) {
            commit('authError')
        }
    }
}
