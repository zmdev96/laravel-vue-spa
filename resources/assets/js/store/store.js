import {getLocalUser} from '../helpers/auth';
const user = getLocalUser();
export default {
  state: {
    currentUser: user,
    isLoggedIn: !!user,
    loading: false,
    auth_error: null,
  },
  getters:{
    currentUser(state){
      return state.currentUser;
    },
    isLoggedIn(state){
      return state.isLoggedIn;
    },
    isLoading(state){
      return state.loading;
    },
    authError(state){
      return state.auth_error;
    }
  },
  mutations: {
    login(state) {
      state.loading = true;
      state.auth_error = null;
    },
    loginSuccess(state, payload) {
      state.auth_error = null;
      state.isLoggedIn = true;
      state.loading = false;
      state.currentUser = Object.assign({}, payload.user, payload.profile, {token: payload.access_token});
      localStorage.setItem('user', JSON.stringify(state.currentUser));
    },
    refreshUser(state) {
      state.loading = true;
      state.auth_error = null;
    },
    UpdateUser(state, payload) {
      state.auth_error = null;
      state.isLoggedIn = true;
      state.loading = false;
      state.currentUser = Object.assign({}, payload.user, payload.profile, {token: payload.access_token});
      localStorage.setItem('user', JSON.stringify(state.currentUser));
    },
    loginFailed(state, payload) {
      state.loading = false;
      state.auth_error = payload.error;
    },
    logout(state) {
      localStorage.removeItem('user');
      state.loading = false;
      state.currentUser = null;
      state.isLoggedIn = false;
    },
  },
  actions: {
    login(context) {
      context.commit('login');
    },
    refreshUser(context) {
      context.commit('refreshUser');
    },
  },

}
