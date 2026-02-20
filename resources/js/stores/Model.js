import api from '@core/api';

export default class {
    constructor(data) {
        Object.assign(this, data);
    }

    static async fetch(id, repository) {
        const endpoint = this.name.toLowerCase() + 's' + '/' + id + '/read'; // TODO Don't just stick an S on the end, use a plural library.

        const entity = (await api.get(endpoint)).data;

        if (repository) {
            repository().save(entity);
        }

        return entity;
    }

    is(other) {
        return this.constructor === other.constructor && this.id === other.id;
    }
}
