import Vue from 'vue'
import Vuex from "vuex"
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)
const plugins = [createPersistedState()]

import state from "./state"
import mutations from "./mutations"

export default new Vuex.Store({
    plugins,
    state,
    mutations,
});