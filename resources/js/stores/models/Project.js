import Filters from '../Filters';
import Model from '../Model';
import {
    useFeaturesStore,
    useUsersStore
} from '@/stores';

export default class Project extends Model {
    constructor(data) {
        super(data);

        this.filters = new Filters(this.id);
    }

    get features() {
        return useFeaturesStore().collection.where('project_id', this.id);
    }
    set features(features) {
        useFeaturesStore().saveMany(features);
    }

    get features_estimate() {
        return this.features.sum('requirements_estimate');
    }
    
    get total_estimate() {
        return this.features_estimate;
    }

    get users() {
        return useUsersStore().collection.where('project_id', this.id);
    }
    set users(users) {
        useUsersStore().saveMany(users);
    }
}
