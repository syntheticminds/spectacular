import Model from '../Model';
import { useProjectsStore } from '@core/stores';
import { useRequirementsStore } from '@core/stores';

export default class User extends Model {
    get project() {
        return useProjectsStore().find(this.project_id);
    }

    get requirements() {
        return useRequirementsStore().collection
            .filter(requirement =>requirement.assignments.pluck('user_id').contains(this.id));
    }
}
