
import { createStore } from 'vuex';


import getters from './getters.js'
import actions from './actions.js'
import mutations from './mutations.js'

const store = createStore({
    modules:{},
    state(){
        return{
            employees:[]
        }
    },
    mutations,
    actions,
    getters
});

export default store;
