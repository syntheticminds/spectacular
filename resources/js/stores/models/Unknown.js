import Model from '../Model';
import { useRequirementsStore } from '@/stores';

export default class Unknown extends Model {
    get requirement() {
        return useRequirementsStore().find(this.requirement_id);
    }
}
