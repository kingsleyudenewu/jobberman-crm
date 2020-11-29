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
                    user: response.data.data.user,
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
                    user: response.data.data.user,
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
                    user: response.data.data.user,
                    guard: 'employee'
                }
                await commit('authSuccess', payload );
            }
        }
        catch (error){
            commit('authError')
        }
    },

    logOutAction: async ({commit}, token) => {
        try {
            const token = localStorage.getItem('token') ?? token;
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

    getCompanyAction: async ({commit}, currentPage) => {
        try {
            const token = localStorage.getItem('token');
            const response = await axios({
                'method': 'get',
                'url': '/api/v1/companies?page='+ currentPage,
                headers: { Authorization: `Bearer ${token}` }
            });

            if (response.data.message === 'success') {
                await commit('setCompany', response.data.data);
            }
        }
        catch (error) {
            commit('authError')
        }
    },
    getEmployeeAction: async ({commit}, currentPage) => {
        try {
            const token = localStorage.getItem('token');
            const response = await axios({
                'method': 'get',
                'url': '/api/v1/employees?page='+ currentPage,
                headers: { Authorization: `Bearer ${token}` }
            });

            if (response.data.message === 'success') {
                await commit('setEmployee', response.data.data);
            }
        }
        catch (error) {
            commit('authError');
        }
    },
    fetchProfile: async ({commit}, token, guard) => {
        let url = '';
        if (guard === 'user') {
            url = '/api/v1/users/profile';
        }
        if (guard === 'employee') {
            url = '/api/v1/employees/profile';
        }
        if (guard === 'company') {
            url = '/api/v1/companies/profile';
        }

        const response = await axios({
            'method':'get',
            'url':url,
            headers: { Authorization: `Bearer ${token}` }
        });
        if (response.data.message === 'success') {
            await commit('setUser', response.data.data);
        }
    },
    updateProfileAction: async ({commit, state}, {name, email, password}) => {
        try{
            let url = '';
            if (state.guard === 'user') {
                url = '/api/v1/users/profile/update';
            }
            if (state.guard === 'employee') {
                url = '/api/v1/employees/profile/update/'+state.user.id;
            }
            if (state.guard === 'company') {
                url = '/api/v1/companies/profile/update/'+state.user.id;
            }

            // const token = localStorage.getItem('token');
            const response = await axios({
                'method': 'post',
                'url': url,
                headers: { Authorization: `Bearer ${state.token}` },
                data: {
                    name: name,
                    email: email,
                    password: password
                }
            });
            if (response.data.statusCode === 201) {
                await commit('setUser', response.data.data);
            }
        }
        catch (error) {
            // commit('authError')
            console.log(error);
        }
    }
}
