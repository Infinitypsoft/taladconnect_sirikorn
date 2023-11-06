import Vue from 'vue'
import Vuetify from 'vuetify'
import '../../node_modules/vuetify/dist/vuetify.min.css';
import '../../node_modules/@mdi/font/css/materialdesignicons.css';
import '../../node_modules/material-design-icons-iconfont/dist/material-design-icons.css'
Vue.use(Vuetify)

export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: '#3f51b5',
                secondary: '#696969',
                accent: '#8c9eff',
                error: '#b71c1c',
            },
        },
    },
    icons: {
        iconfont: 'mdiSvg' || 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4' || 'faSvg',
    },
})