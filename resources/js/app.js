require('./bootstrap');
window.Vue = require('vue').default;
import App from '@/js/views/User/App.vue';
import Vuex from 'vuex';
import Vuelidate from 'vuelidate';
import store from '@/js/store';
import AppHelpers from '@/js/helpers.js';
import VueAxios from 'vue-axios';
import vuetify from '@/js/vuetify';
import '../../node_modules/bootstrap/dist/css/bootstrap.min.css';
import Swal from 'sweetalert2';

//  import '../dflip/css/dflip.min.css';
//  import '../dflip/css/themify-icons.min.css';
//  import '../dflip/js/libs/jquery.min.js';
//  import '../dflip/js/dflip.min.js';
import '../../node_modules/vuetify/lib';
import VueRouter from 'vue-router';
import axios from 'axios';
import routes from '@/js/routes/frontend/index.js';
import { base64Encode, base64Decode } from '@/js/helpers/base64.js'
import { formatNumber, isNumberOnly } from '@/js/helpers/numberformats.js'

// assign global config
window.axios.defaults.crossDomain = true;
window.axios.defaults.baseURL = process.env.API_URL;

// init vue
Vue.component('example-component', require('@/js/views/User/App.vue').default);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Vuex);
Vue.use(AppHelpers);
Vue.use(Vuelidate);
window.Swal = Swal;

Vue.mixin({
    data() {
      return {
        base_url: process.env.APP_URL,
        api_url: process.env.API_URL,
        rulesEmail: {
          required: value => !!value || 'กรุณากรอกอีเมล',
          email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'กรุณากรอกอีเมลให้ถูกต้อง'
          },
        },
      };
    },
    methods: {
      linkPage(link) {
        this.$router.push(link)
      },
      base64Encode(id) {
        return base64Encode(id)
      },
      base64Decode(id) {
        return base64Decode(id)
      },
      formatNumber(evt) {
        return formatNumber(evt)
      },
      formatPrice(evt) {
        return formatPrice(evt)
      },
      isNumberOnly(evt) {
        return isNumberOnly(evt)
      },
      isEmail: function (evt) {
        return validateEmail(evt)
      },
      isPaste: function (evt) {
        return onPaste(evt)
      },
      isTelephone: function (evt, number) {
        return isTelephone(evt, number)
      },
      async alertData(type, title, detail) {
        let timerInterval;
        Swal.fire({
          title: title,
          icon: type,
          html: detail,
          timer: 2000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector("b");
            timerInterval = setInterval(() => {
              b.textContent = Swal.getTimerLeft();
            }, 100);
          },
          willClose: () => {
            clearInterval(timerInterval);
          },
        });
      },
      async alertPerDelete(type, title, detail) {
        Swal.fire({
          title: title,
          text: detail,
          icon: type,
          showCancelButton: true,
          confirmButtonColor: '#3BB143',
          cancelButtonColor: '#F01705',
          confirmButtonText: 'ใช่, ฉันแน่ใจ',
          cancelButtonText: 'ยกเลิก'
        })
      },
    }
  });



const app = new Vue({
  el: '#app',
  router: routes,
  vuetify,
  store,
  render: h => h(App),
});


export default app;
