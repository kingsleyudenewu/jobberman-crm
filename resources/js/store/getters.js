export default {
    isAuthenticated: state => state.isLoggedIn,
    getGuard: state => state.guard,
    getToken: state => state.token
}
