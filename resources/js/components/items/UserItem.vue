<template>
    <div class="flex justify-between items-start">
        <div>
            <h3 class="font-semibold text-xl mb-2">{{ user.name }}</h3>
            <TextMultiline v-if="user.summary" :text="user.summary" />
            <p v-if="!user.summary" class="text-gray-400">No description</p>
        </div>

        <DropdownMenu class="d-print-none">
            <DropdownMenuItem icon="edit" :to="{name: 'projects.users.edit', params: { user_id: user.id }}" replace>Edit</DropdownMenuItem>
            <DropdownMenuItem icon="trash" @click="openUserDeleteModal" danger replace>Delete</DropdownMenuItem>
        </DropdownMenu>
    </div>
</template>

<script>
import DropdownMenu from '@core/components/DropdownMenu.vue';
import DropdownMenuItem from '@core/components/DropdownMenuItem.vue';
import TextMultiline from '@core/components/TextMultiline.vue';
import UserDelete from '@core/components/modals/UserDelete.vue';
import { useModalStore } from '@core/stores';

export default {
    components: {
        DropdownMenu,
        DropdownMenuItem,
        TextMultiline
    },
    methods: {
        openUserDeleteModal() {
            useModalStore().open(UserDelete, {user: this.user});
        },
    },
    props: [
        'user'
    ],
};
</script>
