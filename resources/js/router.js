import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)


import home from './components/home'
import tags from './components/admin/pages/tags'
import category from './components/admin/pages/category'
import user from './components/admin/pages/user'



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
    {
        path: '/user',
        component: user
    },


]

export default new Router({
    mode: 'history',
    routes
})
