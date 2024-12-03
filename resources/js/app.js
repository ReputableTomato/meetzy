import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { createStore } from 'vuex';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import Echo from 'laravel-echo';
import axios from 'axios';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

// Create Vuex store
const store = createStore({
    state() {
        return {
            isNightMode: false,
            isLoading: true,
            echo: null,
            posts: [],
        };
    },
    mutations: {
        toggleNightMode(state) {
            state.isNightMode = !state.isNightMode;
        },
        setNightMode(state, value) {
            state.isNightMode = value;
        },
        hidePreloader(state) {
            state.isLoading = false;
        },
    },
    actions: {
        toggleDayNight({ commit }) {
            document.body.classList.toggle('night_mode');

            const isNightMode = document.body.classList.contains('night_mode');
            localStorage.setItem('night_mode', isNightMode ? 'true' : 'false');
            commit('setNightMode', isNightMode);
        },
        loadNightModeFromStorage({ commit }) {
            const nightModeEnabled = localStorage.getItem('night_mode') === 'true';
            if (nightModeEnabled) {
                document.body.classList.add('night_mode');
            }
            commit('setNightMode', nightModeEnabled);
        },
        hidePreloader({ commit }) {
            setTimeout(() => {
                commit('hidePreloader');
            }, 400);
        }
    }
});

window.echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.echo.connector.pusher.connection.bind('error', (payload) => {
    axios.get('/user').then(response => {
        // do nothing as this is an authentication check
    })
    .catch(error => {
        window.location.href = '/login';
    });
});

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(store)  // Use Vuex store
            .use(Toast)
            .mixin({
                mounted() {
                    this.$store.dispatch('loadNightModeFromStorage');

                    window.addEventListener('load', () => this.$store.dispatch('hidePreloader'));
                },
                beforeDestroy() {
                    window.removeEventListener('load', () => this.$store.dispatch('hidePreloader'));
                },
                methods: {
                    toggleDayNight() {
                        this.$store.dispatch('toggleDayNight');
                    }
                }
            })
            .mount(el);
    },
});
