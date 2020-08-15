import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)


import firstPage from './components/pages/myNewVuePage'
import newRoutePage from './components/pages/myNewRoutePage'
import hook from './components/pages/basic/hooks'
import home from './components/pages/home'
import tags from './components/pages/tags'



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
        path: '/my-new-vue-route',
        component: firstPage
    },
    {
        path: '/new-route',
        component: newRoutePage
    },
    //hooks
    {
        path: '/hooks',
        component: hook
    },
    //more basic
    {
        path: '/datas',
        component: () => import('./components/pages/basic/datas.vue')
    },

]

export default new Router({
    mode: 'history',
    routes
})
