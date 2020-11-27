export default {
    authSuccess: (state, token) => {
        state.isLoggedIn = true;
        state.token = token;
    },
    authError: (state) => {
        state.isLoggedIn = false;
        state.token = null;
    }
}
