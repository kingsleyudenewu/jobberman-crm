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

            if (response.message === 'success') {
                await commit('authSuccess', response.data.access_token );
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

            if (response.message === 'success') {
                await commit('authSuccess', response.data.access_token );
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

            if (response.message === 'success') {
                await commit('authSuccess', response.data.access_token );
            }
        }
        catch (error){
            commit('authError')
        }
    },

    logoutAction: async ({commit}, token) => {
        try {
            const response = await axios({
                'method': 'post',
                'url': '/api/v1/logout',
            });
        }
        catch (error) {
            commit('authError')
        }
    }
}
