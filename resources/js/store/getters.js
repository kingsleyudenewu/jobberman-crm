export default {
    isAuthenticated: state => state.isLoggedIn,
    getGuard: state => state.guard,
    getToken: state => state.token,
    getCompany: state => state.company,
    getEmployee: state => state.employee,
    getUser: state => state.user,
}
