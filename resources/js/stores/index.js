import alerts from './modules/alerts';
import Assignment from './models/Assignment';
import Feature from './models/Feature';
import modal from './modules/modal';
import Project from './models/Project';
import Unknown from './models/Unknown';
import Repository from './Repository';
import Requirement from './models/Requirement';
import Task from './models/Task';
import User from './models/User';
import { defineStore } from 'pinia';

export const useAlertsStore = defineStore('alerts', alerts);
export const useModalStore = defineStore('modal', modal);

export const useAssignmentsStore = defineStore('assignments', Repository(Assignment));
export const useFeaturesStore = defineStore('features', Repository(Feature));
export const useProjectsStore = defineStore('projects', Repository(Project));
export const useUnknownsStore = defineStore('unknowns', Repository(Unknown));
export const useRequirementsStore = defineStore('requirements', Repository(Requirement));
export const useTasksStore = defineStore('tasks', Repository(Task));
export const useUsersStore = defineStore('users', Repository(User));

export function resetRepositories() {
    useAssignmentsStore().$reset();
    useFeaturesStore().$reset();
    useProjectsStore().$reset();
    useUnknownsStore().$reset();
    useRequirementsStore().$reset();
    useTasksStore().$reset();
    useUsersStore().$reset();
}
