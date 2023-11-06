import { Store } from 'vuex';

const getDefaultState = () => {
  return {
    //admin
    access_token: localStorage.getItem('access_token') || null,
    role: localStorage.getItem('role') || null,
    profile: localStorage.getItem("profile") || null,
    cookies: localStorage.getItem('cookies') || null,
    //user
    access_token_u: localStorage.getItem('access_token_u') || null,
    role_u: localStorage.getItem('role_u') || null,
    profile_u: localStorage.getItem("profile_u") || null,
    cookies_u: localStorage.getItem('cookies_u') || null,
  }
}

const state = getDefaultState()

export default {
  namespaced: true,
  state,
  statee: state,
  getters: {
    isAuthorized(state) {
      return state.access_token !== null;
    },
    getAccessToken(state) {
      return state.access_token
    },
    getRole(state) {
      return state.role
    },
    getProfile(state){
      return state.profile
    },
    getCookies(state) {
      return state.cookies
    },
    //user
    isAuthorized_u(statee) {
      return statee.access_token_u !== null;
    },
    getAccessToken_u(statee) {
      return statee.access_token_u
    },
    getRole_u(statee) {
      return statee.role_u
    },
    getProfile_u(statee){
      return statee.profile_u
    },
    getCookies_u(state) {
      return statee.cookies_u
    },
  },
  mutations: {
    RESET_STATE(state) {
      Object.assign(state, getDefaultState())
    },
    SET_ACCESS_TOKEN(state, access_token) {
      state.access_token = access_token;
    },
    SET_ROLE(state, role) {
      state.role = role;
    },
    SET_PROFILE(state, profile) {
      state.profile = profile;
    },
    SET_COOKISE(state, cookies) {
      state.cookies = cookies;
    },
    //user
    RESET_STATE(statee) {
      Object.assign(statee, getDefaultState())
    },
    SET_ACCESS_TOKEN_U(statee, access_token_u) {
      statee.access_token_u = access_token_u;
    },
    SET_ROLE_U(statee, role_u) {
      statee.role_u = role_u;
    },
    SET_PROFILE_U(statee, profile_u) {
      statee.profile_u = profile_u;
    },
    SET_COOKISE_U(statee, cookies_u) {
      statee.cookies_u = cookies_u;
    },
  },
  actions: {
    async attempt({ commit, state, dispatch }, { access_token, role , cookies}) {
      if (isNotEmpty(cookies)) {
        commit('SET_COOKISE', cookies);
      }
      if (isNotEmpty(access_token)) {
        commit('SET_ACCESS_TOKEN', access_token);
        commit('SET_ROLE', role);
      }

      if (state.access_token) {
        return Promise.resolve(true)
      }else{
        commit('SET_ACCESS_TOKEN', null);
        commit('SET_ROLE', null);
        commit('RESET_STATE');
        return Promise.resolve(false)
      }
    },
    //user
    async attempt_u({ commit, statee, dispatch }, { access_token_u, role_u , cookies_u}) {
      if (isNotEmpty(cookies_u)) {
        commit('SET_COOKISE_U', cookies_u);
      }
      if (isNotEmpty(access_token_u)) {
        commit('SET_ACCESS_TOKEN_U', access_token_u);
        commit('SET_ROLE_U', role_u);
      }

      if (statee.access_token_u) {
        return Promise.resolve(true)
      }else{
        commit('SET_ACCESS_TOKEN_U', null);
        commit('SET_ROLE_U', null);
        commit('RESET_STATE_U');
        return Promise.resolve(false)
      }
    },
    async setAccessToken({ dispatch, commit }, {access_token, role}) {
      try {
        commit('SET_ACCESS_TOKEN', access_token);
        commit('SET_ROLE', role ? role : null);

        let profile = await axios.get('/user')

        if (isNotEmpty(access_token)) {
          commit("SET_PROFILE", JSON.stringify(profile.data));
          return Promise.resolve(true)
        } else {
          commit('SET_ACCESS_TOKEN', null);
          commit('RESET_STATE');
          return Promise.resolve(false)
        }
      } catch (error) {
        return Promise.reject(error)
      }
    },
    //user
    async setAccessToken_U({ dispatch, commit }, {access_token_u, role_u}) {
      try {
        commit('SET_ACCESS_TOKEN_U', access_token_u);
        commit('SET_ROLE_U', role_u ? role_u : null);

        let profile = await axios.get('/user')

        if (isNotEmpty(access_token_u)) {
          commit("SET_PROFILE_U", JSON.stringify(profile.data));
          return Promise.resolve(true)
        } else {
          commit('SET_ACCESS_TOKEN_U', null);
          commit('RESET_STATE_U');
          return Promise.resolve(false)
        }
      } catch (error) {
        return Promise.reject(error)
      }
    },
    async signOut({ commit }) {
      commit('SET_ACCESS_TOKEN', null);
      commit('SET_ROLE', null);
      commit('SET_PROFILE', null);
      commit('RESET_STATE');
    },
    //user
    async signOut_U({ commit }) {
      commit('SET_ACCESS_TOKEN_U', null);
      commit('SET_ROLE_U', null);
      commit('SET_PROFILE_U', null);
      commit('RESET_STATE_U');
    },
    async setCookies({ dispatch, commit }, cookies) {
    try {
      // localStorage.ticket = code.toString();
      commit('SET_COOKISE', cookies);

      if (isNotEmpty(cookies)) {
        dispatch('attempt', { cookies })
        return Promise.resolve(true)
      } else {
        commit('SET_COOKISE', null);
        commit('RESET_STATE');
        return Promise.resolve(false)
      }
    } catch (error) {
      return Promise.reject(error)
    }
  },
  //user
    async setCookies({ dispatch, commit }, cookies_u) {
    try {
      // localStorage.ticket = code.toString();
      commit('SET_COOKISE_U', cookies_u);

      if (isNotEmpty(cookies_u)) {
        dispatch('attempt_u', { cookies_u })
        return Promise.resolve(true)
      } else {
        commit('SET_COOKISE_U', null);
        commit('RESET_STATE_U');
        return Promise.resolve(false)
      }
    } catch (error) {
      return Promise.reject(error)
    }
  },
  }
};
