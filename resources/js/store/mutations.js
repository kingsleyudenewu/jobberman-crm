export default {
    authSuccess: (state, {token, guard, user}) => {
        state.isLoggedIn = true;
        state.token = token;
        state.guard = guard;
        state.user = user;
        localStorage.setItem('token', token);
    },
    authError: (state) => {
        state.isLoggedIn = false;
        state.token = null;
        state.guard = null;
        state.user = null;
    },
    authLogOut: (state) => {
        state.isLoggedIn = false;
        state.token = null;
        state.guard = null;
        state.user = null;
    },
    setCompany: (state, company) => {
        state.company = company;
    },
    setEmployee: (state, employee) => {
        state.employee = employee;
    }
}
