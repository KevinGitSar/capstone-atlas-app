import './bootstrap';
import { createApp, VueElement } from 'vue/dist/vue.esm-bundler';

import AppHeader from '../components/AppHeader.vue';
import MainNavBar from '../components/MainNavBar.vue';
import UserNavbar1 from '../components/UserNavbar1.vue';
import AdminNavBar from '../components/AdminNavBar.vue';
import Gallery from '../components/Gallery.vue';

const app = createApp({
    components: {
        'Appheader' : AppHeader,
        'Mainnavbar' : MainNavBar,
        'Usernavbar1' : UserNavbar1,
        'Adminnavbar' : AdminNavBar,
        'Gallery': Gallery
    }
});

app.mount("#app");
