import Model from '../Model';
import { useRequirementsStore } from '@core/stores';

export default class Unknown extends Model {
    get requirement() {
        return useRequirementsStore().find(this.requirement_id);
    }
}
