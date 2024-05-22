import { createStore } from 'vuex'

export default createStore({
  state() {
    return {
      loadingCounter: 0,
      viewMode: localStorage.getItem('viewMode') ?? 'light',
      route: null,
      router: null,
      notify: null,
    }
  },
  getters: {
      isLoading(state) {
          return state.loadingCounter !== 0;
      },
  },
  mutations: {
    startLoading(state) {
      state.loadingCounter++;
    },
    stopLoading(state) {
      state.loadingCounter--;
    },
    setRoute(state, payload) {
      state.route = payload;
    },
    setRouter(state, payload) {
      state.router = payload;
    },
    setNotify(state, payload) {
      state.notify = payload;
    },
    setViewMode(state, payload) {
      state.viewMode = payload;
      localStorage.setItem('viewMode', payload);
    },
  }
})