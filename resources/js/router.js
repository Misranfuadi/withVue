import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)


import home from './components/pages/home'
import tags from './components/pages/admin/tags'
import category from './components/pages/admin/category'



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
