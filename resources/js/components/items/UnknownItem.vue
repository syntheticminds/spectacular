<template>
    <div class="bg-yellow-200 flex items-center justify-between px-4 py-2">
        <p>
            {{ unknown.name }}
        </p>

        <DropdownMenu>
            <DropdownMenuItem icon="check-lg" @click="openUnknownResolveModal">Resolve</DropdownMenuItem>
        </DropdownMenu>
    </div>
</template>

<script>
import DropdownMenu from '@core/components/DropdownMenu.vue';
import DropdownMenuItem from '@core/components/DropdownMenuItem.vue';
import UnknownResolve from '@core/components/modals/UnknownResolve.vue';
import { useModalStore } from '@core/stores';

export default {
    components: {
        DropdownMenu,
        DropdownMenuItem,
    },
    props: [
        'unknown'
    ],
    methods: {
        openUnknownResolveModal() {
            useModalStore().open(UnknownResolve, {unknown: this.unknown});
        },
    },
};
</script>
