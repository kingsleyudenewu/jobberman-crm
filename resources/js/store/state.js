export default {
    isLoggedIn: !!localStorage.getItem('token'),
    token: localStorage.getItem('token'),
    guard: null
}
