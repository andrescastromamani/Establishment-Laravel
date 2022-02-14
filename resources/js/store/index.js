import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        hospitals: [],
        restaurants: [],
        gyms: [],
        universities: [],
    },
    mutations: {
        ADD_HOSPITAL(state, hospitals) {
            state.hospitals = hospitals
        },
        ADD_RESTAURANT(state, restaurants) {
            state.restaurants = restaurants
        },
        ADD_GYM(state, gyms) {
            state.gyms = gyms
        },
        ADD_UNIVERSITY(state, universities) {
            state.universities = universities
        },
    },
});
