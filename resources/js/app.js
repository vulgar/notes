import { createApp } from 'vue/dist/vue.esm-bundler';
import './bootstrap';

import App from './App.vue';
import router from './router';
// import { plugin, defaultConfig } from '@formkit/vue';

const app = createApp(App);

app.use(router);
// app.use(plugin,defaultConfig);

app.mount('#app');
// const app = createApp({}).mount('#app');
