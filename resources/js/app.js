import './bootstrap';
import { createApp } from 'vue';
import App from './components/TaskManager.vue';
import router from './router';
import 'bootstrap';

// Import Ziggy directly from vendor
import { route } from 'ziggy-js';

const app = createApp(App);
app.use(router);

// Provide the route function globally
app.provide('$route', route);

app.mount('#app');
