import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        deleteObj: {
            title: '',
            deleteModal: false,
            url: '',
            data: null,
            index: -1,
            isDeleted: false
        },
        user: false
    },
    getters: {
        getDeleteObj(state) {
            return state.deleteObj
        },
        getUserPermission(state) {
            return state.permission
        }
    },

    mutations: {
        setDeleteModal(state, data) {
            const obj = {
                deleteModal: false,
                index: state.deleteObj.index,
                isDeleted: data
            }
            state.deleteObj = obj
        },
        setDeleteModalObj(state, data) {
            state.deleteObj = data
        },
        updateUser(state, data) {
            state.user = data
        },
        userPermission(state, data) {
            state.permission = data
        }

    }
})
