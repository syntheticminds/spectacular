import Model from '../Model';
import { useProjectsStore } from '@/stores';
import { useRequirementsStore } from '@/stores';

export default class User extends Model {
    get project() {
        return useProjectsStore().find(this.project_id);
    }

    get requirements() {
        return useRequirementsStore().collection
            .filter(requirement =>requirement.assignments.pluck('user_id').contains(this.id));
    }
}
