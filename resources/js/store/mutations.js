export default {
    authSuccess: (state, {token, guard}) => {
        state.isLoggedIn = true;
        state.token = token;
        state.guard = guard;
        localStorage.setItem('token', token);
    },
    authError: (state) => {
        state.isLoggedIn = false;
        state.token = null;
        state.guard = null;
    },
    authLogOut: (state) => {
        state.isLoggedIn = false;
        state.token = null;
        state.guard = null;
    },
    setCompany: (state, company) => {
        state.company = company;
    },
    setEmployee: (state, employee) => {
        state.employee = employee;
    }
}
