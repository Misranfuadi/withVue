import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)


import home from './components/home'
import tags from './components/admin/pages/tags'
import category from './components/admin/pages/category'



const routes = [

    {
        path: '/',
        component: home
    },

    {
        path: '/tags',
        component: tags
    },

    {
        path: '/category',
        component: category
    },


]

export default new Router({
    mode: 'history',
    routes
})
