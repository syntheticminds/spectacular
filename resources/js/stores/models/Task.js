import Model from '../Model';
import { useRequirementsStore } from '@/stores';

export default class Task extends Model {
    get requirement() {
        return useRequirementsStore().find(this.requirement_id);
    }
}
