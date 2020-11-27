import axios from 'axios';

export default {
    loginAction: async ({commit}, {email, password}) => {
        try{
            const response = await axios({
                'method': 'post',
                'url': '/api/v1/auth/login',
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
