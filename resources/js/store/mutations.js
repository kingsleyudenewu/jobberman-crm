export default {
    authSuccess: (state, {token, guard}) => {
        state.isLoggedIn = true;
        state.token = token;
        state.guard = guard;
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
    }
}
