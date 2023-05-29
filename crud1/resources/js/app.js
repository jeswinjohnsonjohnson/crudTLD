require  ('./bootstrap');
import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import { routes } from "./router/routes";
import axios from 'axios';
import VueAxios from 'vue-axios'
import Swal from 'sweetalert2';

const app = createApp({
});
const router = createRouter({
  routes,
  history: createWebHistory(),
});




const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 4000,
  width:'33em',
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Swal = Swal;
window.Toast = Toast;





app.use(router);
app.use(VueAxios, axios);


router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('token');
  if (to.matched.some(route => route.meta.requiresAuth) && !isAuthenticated) {
    next({ name: 'login' });
  } else {
    next();
  }
});


axios.defaults.baseURL = process.env.MIX_API_URL
window.vm = app.mount("#app");

