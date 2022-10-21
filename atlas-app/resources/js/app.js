import './bootstrap';
import { createApp, VueElement } from 'vue/dist/vue.esm-bundler';

import AppHeader from '../components/AppHeader.vue';
import MainNavBar from '../components/MainNavBar.vue';
import UserNavbar1 from '../components/UserNavbar1.vue';
import UserNavbar2 from '../components/UserNavbar2.vue';
import Gallery from '../components/Gallery.vue';

const app = createApp({
    components: {
        'Appheader' : AppHeader,
        'Mainnavbar' : MainNavBar,
        'Usernavbar1' : UserNavbar1,
        'Usernavbar2' : UserNavbar2,
        'Gallery': Gallery
    }
});

app.mount("#app");
