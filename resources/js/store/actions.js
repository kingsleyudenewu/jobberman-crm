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

            console.log(response.data);

            if (response.data.message === 'success') {
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
            const response = await axios({
                'method': 'post',
                'url': '/api/v1/logout',
            });

            if (response.data.message === 'success') {
                await commit('authLogOut');
            }
        }
        catch (error) {
            commit('authError')
        }
    }
}
