import FeatureForm from '@/components/sidepanels/Feature.vue';
import ProjectEdit from '@/components/sidepanels/ProjectEdit.vue';
import ProjectShow from '@/components/pages/ProjectShow.vue';
import ProjectOrganise from '@/components/sidepanels/ProjectOrganise.vue';
import ProjectCreate from '@/components/pages/ProjectCreate.vue';
import RequirementForm from '@/components/sidepanels/Requirement.vue';
import UserForm from '@/components/sidepanels/User.vue';

export default [
    {
        name: 'projects.create',
        path: '/projects/create',
        meta: { title: 'Create project' },
        component: ProjectCreate,
    }, {
        name: 'projects.show',
        path: '/projects/:project_id',
        component: ProjectShow,
        props: true,
        children: [
            {
                name: 'projects.edit',
                path: 'edit',
                meta: { title: 'Edit project' },
                components: { sidepanel: ProjectEdit },
                props: true,
            }, {
                name: 'projects.organise',
                path: 'organise',
                meta: { title: 'Organise project' },
                components: { sidepanel: ProjectOrganise },
                props: true,
            }, 

            // Users
            {
                name: 'projects.users.create',
                path: 'users/create',
                meta: { title: 'Create user' },
                components: { sidepanel: UserForm },
                props: true,
            }, {
                name: 'projects.users.edit',
                path: 'users/:user_id/edit',
                meta: { title: 'Edit user' },
                components: { sidepanel: UserForm },
                props: true,
            },

            // Features
            {
                name: 'projects.features.create',
                path: 'features/create',
                meta: { title: 'Create feature' },
                components: { sidepanel: FeatureForm },
                props: true,
            }, {
                name: 'projects.features.edit',
                path: 'features/:feature_id/edit',
                meta: { title: 'Edit feature' },
                components: { sidepanel: FeatureForm },
                props: true,
            }, {
                name: 'projects.features.requirements.create',
                path: 'features/:feature_id/requirements/create',
                meta: { title: 'Create requirement' },
                components: { sidepanel: RequirementForm },
                props: true,
            },

            // Requirements
            {
                name: 'projects.requirements.create',
                path: 'requirements/create',
                meta: { title: 'Create requirement' },
                components: { sidepanel: RequirementForm },
                props: true,
            }, {
                name: 'projects.requirements.edit',
                path: 'requirements/:requirement_id/edit',
                meta: { title: 'Edit requirement' },
                components: { sidepanel: RequirementForm },
                props: true,
            },
        ],
    },
];
