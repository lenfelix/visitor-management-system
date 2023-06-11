import {createStore} from "vuex";
import axiosClient from '../axios';
import router from "../router";

const store = createStore({
    state: {
        user:{
            data: {},
            token: sessionStorage.getItem("TOKEN")
        }
    },
    getters: {},
    actions: { 
        login({commit}, user) {
            return axiosClient.post('/login', user)
              .then(({data}) => {
                commit('setUser', data.user);
                commit('setToken', data.token)
                router.push({name: 'Dashboard'})
                return data;
              })
          },
    },
    mutations: {
        logout: (state) => {
            state.user.token = null;
            state.user.data = {};
            sessionStorage.removeItem("TOKEN");
          },
        setUser: (state, user) => {
            state.user.data = user;
        },
        setToken: (state, token) => {
        state.user.token = token;
        sessionStorage.setItem('TOKEN', token);
        },
    },
    modules: {},
})

export default store;