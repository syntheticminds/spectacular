import Model from '../Model';
import { useAssignmentsStore } from '@/stores';
import { useFeaturesStore } from '@/stores';
import { useTasksStore } from '@/stores';
import { useUnknownsStore } from '@/stores';

export default class Requirement extends Model {
    get assignments() {
        return useAssignmentsStore().collection.where('requirement_id', this.id);
    }
    set assignments(assignments) {
        useAssignmentsStore().saveMany(assignments);
    }

    get feature() {
        return useFeaturesStore().find(this.feature_id);
    }

    get has_unknowns() {
        return this.unknowns.isNotEmpty();
    }

    get has_tasks() {
        return this.tasks.isNotEmpty();
    }

    get is_complete() {
        return this.has_tasks && this.tasks.every(task => task.is_complete);
    }

    get is_blocked() {
        return this.blocked_reason !== null;
    }

    get unknowns() {
        return useUnknownsStore().collection.where('requirement_id', this.id);
    }
    set unknowns(unknowns) {
        useUnknownsStore().saveMany(unknowns);
    }

    get short_title() {
        return this.title.charAt(0).toUpperCase() + this.title.slice(1);
    }

    get tasks() {
        return useTasksStore().collection.where('requirement_id', this.id);
    }
    set tasks(tasks) {
        useTasksStore().saveMany(tasks);
    }

    get title() {
        const users = this.assignments.map(assignment => assignment.user.name);

        if (users.isEmpty()) {
            return 'Users can ' + this.name;
        }

        const last_user = users.pop();

        return (users.isNotEmpty() ? users.join(', ') + ' and ' : ' ') + last_user + ' can ' + this.name;
    }

    get tasks_estimate() {
        return this.tasks.reduce((total, task) => total + task.estimate, 0);
    }

    get is_filtered() {
        const filters = this.feature.project.filters;

        if (typeof filters.statuses.completed === 'boolean' && this.is_complete !== filters.statuses.completed) {
            return true;
        }

        if (typeof filters.statuses.blocked === 'boolean' && this.is_blocked !== filters.statuses.blocked) {
            return true;
        }

        if (typeof filters.statuses.estimated === 'boolean' && this.tasks_estimate > 0 !== filters.statuses.estimated) {
            return true;
        }

        if (typeof filters.statuses.has_tasks === 'boolean' && this.tasks.isNotEmpty() !== filters.statuses.has_tasks) {
            return true;
        }

        if (typeof filters.statuses.has_unknowns === 'boolean' && this.unknowns.isNotEmpty() !== filters.statuses.has_unknowns) {
            return true;
        }

        if (filters.has_users) {
            const user_ids = this.assignments.pluck('user_id');

            if (!Object.entries(filters.users).every(([id, required]) => required ? user_ids.contains(+id) : user_ids.doesntContain(+id))) {
                return true;
            }
        }

        return false;
    }
}
