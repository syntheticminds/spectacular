import '../css/app.css';

import App from './components/App.vue';
import buildRouter from './router';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate)

const router = buildRouter();

createApp(App)
    .use(pinia)
    .use(router)
    .mount('#app');
