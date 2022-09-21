import './bootstrap';
import { createApp, VueElement } from 'vue/dist/vue.esm-bundler';

import AppHeader from '../components/AppHeader.vue';
import MainNavBar from '../components/MainNavBar.vue';
import NavBar2 from '../components/NavBar2.vue';
import Gallery from '../components/Gallery.vue';

const app = createApp({
    components: {
        'Appheader' : AppHeader,
        'Mainnavbar' : MainNavBar,
        'Navbar2' : NavBar2,
        'Gallery': Gallery
    }
});

app.mount("#app");
