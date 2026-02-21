import UserMenu from '@core/components/UserMenu.vue';

const defaults = {
    UserMenu,
};

export default {
    install(app, overrides = {}) {
        const components = { ...defaults, ...overrides };

        Object.entries(components).forEach(([name, component]) => {
            app.component(name, component);
        });
    },
};
