import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import login from './components/login'

import home from './components/home'
import tags from './components/admin/pages/tags'
import category from './components/admin/pages/category'
import role from './components/admin/pages/role'
import user from './components/admin/pages/user'



const routes = [

    {
        path: '/login',
        component: login
    },
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
    {
        path: '/user',
        component: user
    },
    {
        path: '/role',
        component: role
    },


]

export default new Router({
    mode: 'history',
    routes
})
