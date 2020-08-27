import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import login from './components/login'

import home from './components/home'
import tags from './components/admin/pages/tags'
import category from './components/admin/pages/category'
import role from './components/admin/pages/role'
import user from './components/admin/pages/user'
import assign from './components/admin/pages/assign'



const routes = [

    {
        path: '/login',
        component: login
    },
    {
        path: '/',
        component: home,
        name: 'home'
    },

    {
        path: '/tags',
        component: tags,
        name: 'tags'
    },

    {
        path: '/category',
        component: category,
        name: 'category'
    },
    {
        path: '/user',
        component: user,
        name: 'user'

    },
    {
        path: '/role',
        component: role,
        name: 'role'
    },
    {
        path: '/assign',
        component: assign,
        name: 'assign'
    },


]

export default new Router({
    mode: 'history',
    routes
})
