import ProjectsIndex from '@/components/pages/ProjectsIndex.vue';
import NotFound from '@/components/pages/NotFound.vue';
import projects from './projects';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        name: 'home',
        path: '/',
        redirect: { name: 'projects.index' },
    }, {
        name: 'projects.index',
        path: '/projects',
        component: ProjectsIndex,
        meta: { title: 'Projects' },
    },
    ...projects,
    {
        name: '404',
        path: '/:pathMatch(.*)*',
        component: NotFound,
        meta: { title: 'Not found' },
    }
];

const router = createRouter({
    base: '/',
    history: createWebHistory(),
    linkActiveClass: 'active',
    linkExactActiveClass: '',
    routes,
    scrollBehavior(to, from, saved_position) {
        if (to.hash) {
            return; // We handle this in the afterEach() callback.
        }

        // TODO This modal and panel thing can be tidied.
        const has_sidepanel = Object.hasOwn(to.matched.at(-1).components, 'sidepanel');

        if (has_sidepanel) {
            return;
        }

        if (from.name) {
            const had_sidepanel = Object.hasOwn(from.matched.at(-1).components, 'sidepanel');

            if (had_sidepanel) {
                return;
            }
        }

        if (saved_position) {
            return {...saved_position, behavior: 'instant'};
        }

        return { top: 0, behavior: 'instant' };
    }
});

router.isReady().then(() => {
    if (document.getElementById('splash')) {
        document.getElementById('splash').remove();
        document.getElementById('app').classList.remove('hide');
    }
});

router.beforeEach(async (to) => {
    for (const param in to.params) {
        if (param.endsWith('_id')) {
            to.params[param] = parseInt(to.params[param]);
        }
    }
});

router.afterEach(to => {
    if (!to.hash) {
        return;
    }

    // We can't use nextTick() because something else happens before mount.
    setTimeout(() => {
        const element = document.getElementById(to.hash.substring(1));

        if (element) {
            element.scrollIntoView();
        }
    }, 100);
});

export default router;
