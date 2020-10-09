require('./bootstrap');
window.Vue = require('vue');

import router from './router'
import store from './store'
import ViewUI from 'view-design'
import 'view-design/dist/styles/iview.css'
Vue.use(ViewUI)
import common from './common'
Vue.mixin(common);
import jsonToHTML from './jsonToHTML'
Vue.mixin(jsonToHTML);
import Editor from 'vue-editor-js'
Vue.use(Editor)

Vue.component('mainapp', require('./components/mainapp').default)
new Vue({
    el: '#app',
    router,
    store
})
