export function initialize(store, router) {
  router.beforeEach((to, from , next) => {
    const currentUser = store.state.currentUser;
    if (to.path == '/login' && currentUser) {
      if (document.URL == window.config.appUrl + '/login') {
        router.go(-1);
      }
      return next(false);
    }
    if (typeof(to.matched.some(record => record.meta.auth)) !== 'undefined') {
      const requireAuth = to.matched.some(record => record.meta.auth);
      if (requireAuth && !currentUser) {
        next('/login');
      }else {
        next();
      }
    }
    if (typeof(to.matched.some(record => record.meta.notAuth)) !== 'undefined') {
      const notRequireAuth = to.matched.some(record => record.meta.notAuth);
      if (notRequireAuth && currentUser) {
        router.go(-1);
      }else {
        next();
      }
    }
  });

  axios.interceptors.response.use(null, (error) => {
      if (error.response.status == 401) {
        store.commit('logout');
        router.push('/login');
      }
      return Promise.reject(error)
  });

  if (store.getters.currentUser) {
    setAuthorization(store.getters.currentUser.token);
  }
}

export function setAuthorization(token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
}
