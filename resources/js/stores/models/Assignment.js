import Model from '../Model';
import { useRequirementsStore } from '@core/stores';
import { useUsersStore } from '@core/stores';

export default class Assignment extends Model {
    get user() {
        return useUsersStore().find(this.user_id);
    }

    get requirement() {
        return useRequirementsStore().find(this.requirement_id);
    }
}
