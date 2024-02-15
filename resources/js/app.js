import './bootstrap';
import '../css/app.css';
import Layout from '@/Layouts/AppLayout.vue';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import 'flowbite';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${appName} | ${title}`,
    // resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`].default
        if(page.layout === undefined){
            page.layout = Layout;
        }
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
