export default {
    authSuccess: (state, {token, guard}) => {
        state.isLoggedIn = true;
        state.token = token;
        state.guard = guard;
    },
    authError: (state) => {
        state.isLoggedIn = false;
        state.token = null;
    }
}
