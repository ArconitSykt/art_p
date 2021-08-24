
require('./bootstrap');
// import 'material-design-icons-iconfont'
import Vue from 'vue'
import App from './App'
import Vuetify from 'vuetify'
import axios from 'axios'

import 'vuetify/dist/vuetify.min.css'
import ru from 'vuetify/es5/locale/ru'

const opts = {
    icons: {
        iconfont: 'md',
    },
    lang: {
        locales: { ru },
        current: 'ru'
    },
}
Vue.use(Vuetify)

new Vue({
    el: '#app',
    vuetify: new Vuetify(opts),
    axios,
    components: { App },
    template: '<App/>'
});
