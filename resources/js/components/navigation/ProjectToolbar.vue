<template>
    <NavbarButton :to="{ name: 'projects.requirements.create' }" icon="plus-lg" tooltip="Add requirement" class="hidden sm:flex">Add requirement</NavbarButton>
    <NavbarButton :to="{ name: 'projects.organise' }" icon="organise" tooltip="Organise" class="hidden sm:flex" />

    <DropdownMenu class="hidden sm:flex">
        <template #trigger="{ toggle }">
            <Tooltip text="Download">
                <button type="button" class="flex items-center whitespace-nowrap gap-2 p-2 rounded-full border border-gray-100 transition-colors" @click="toggle">
                    <IconSet name="download" class="size-6" />
                </button>
            </Tooltip>
        </template>

        <DropdownMenuItem :href="route('export.html', { project })" icon="html-file" download>HTML</DropdownMenuItem>
        <DropdownMenuItem :href="route('export.markdown', { project })" icon="markdown-file" download>Markdown</DropdownMenuItem>
    </DropdownMenu>

    <slot name="after" />
</template>

<script>
import DropdownMenu from '@core/components/DropdownMenu.vue';
import DropdownMenuDivider from '@core/components/DropdownMenuDivider.vue';
import DropdownMenuItem from '@core/components/DropdownMenuItem.vue';
import IconSet from '@core/components/IconSet.vue';
import NavbarButton from '@core/components/NavbarButton.vue';
import Tooltip from '@core/components/Tooltip.vue';
import { route } from 'ziggy-js';
import { Ziggy } from '@core/ziggy.js';

export default {
    components: {
        DropdownMenu,
        DropdownMenuDivider,
        DropdownMenuItem,
        IconSet,
        NavbarButton,
        Tooltip,
    },
    methods: {
        route(name, params = {}, absolute = false) {
            return route(name, params, absolute, Ziggy);
        },
    },
    props: ['project'],
};
</script>
