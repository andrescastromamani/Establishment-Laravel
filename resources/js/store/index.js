import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        hospitals: []
    },
    mutations: {
        ADD_HOSPITAL(state, hospitals) {
            state.hospitals = hospitals
        },
    },
});
