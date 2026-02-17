import Model from '../Model';
import { useProjectsStore, useRequirementsStore } from '@/stores';

export default class Feature extends Model {
    get has_tasks () {
        return this.requirements.some(requirement => requirement.has_tasks);
    }

    get project() {
        return useProjectsStore().find(this.project_id);
    }

    get requirements() {
        return useRequirementsStore().collection.where('feature_id', this.id);
    }
    set requirements(requirements) {
        useRequirementsStore().saveMany(requirements);
    }
    
    get requirements_estimate () {
        return this.requirements.reduce((total, requirement) => total + requirement.tasks_estimate, 0);
    }
}
