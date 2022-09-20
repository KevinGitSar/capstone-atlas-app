import './bootstrap';
// require('./bootstrap');

import {createApp, VueElement} from 'vue';

import Gallery from '../components/Gallery.vue';
import Login from '../components/Login.vue';
import NavBar from '../components/NavBar.vue';
import Header from '../components/Header.vue';

createApp(Header).mount("#header")
createApp(NavBar).mount("#navbar")
createApp(Gallery).mount("#gallery")

createApp(Login).mount("#login")