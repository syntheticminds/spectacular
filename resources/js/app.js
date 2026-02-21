import '../css/app.css';

import App from '@core/components/App.vue';
import buildRouter from '@core/router';
import components from '@core/components';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
import { createApp } from 'vue';
import { createPinia } from 'pinia';

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate)

const router = buildRouter();

const app = createApp(App)
    .use(pinia)
    .use(router)
    .use(components)
    .mount('#app');
