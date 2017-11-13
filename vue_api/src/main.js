// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import VueRouter from 'vue-router';
import Products from './components/products.vue';
import NewProduct from './components/new_product.vue';
import Cart from './components/cart.vue';
import Carts from './components/carts.vue';
import NewCart from './components/new_cart.vue';
import SignUp from './components/signup.vue';
import SignIn from './components/signin.vue';

Vue.use(VueRouter);

const routes = [
  { path: '/',component: Products},
  { path: '/new_product', component: NewProduct},
  { path: '/signup', component: SignUp},
  { path: '/signin', component: SignIn},
  { path: '/carts', component: Carts},
  { path: '/new_cart', component: NewCart},
  { path: '/cart', component: NewCart}
]
const router = new VueRouter({routes});

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router: router,
  render: h => h(App)
})
