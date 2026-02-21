import UserMenu from '@core/components/UserMenu.vue';

const components = {
    UserMenu,
};

export default {
    install(app) {
        Object.entries(components).forEach(([name, component]) => app.component(name, component));
    },
};
