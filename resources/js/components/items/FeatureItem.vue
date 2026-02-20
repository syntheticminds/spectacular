<template>
    <section
        v-if="!is_filtered"
        :id="'feature_' + feature.id"
        class="mb-4 bg-white p-8 py-4 shadow rounded-3xl print:p-0 print:shadow-none outline-2 duration-500"
        :class="is_active || highlight ? 'outline-offset-3 outline-gray-800' : 'outline-transparent'">

        <div class="flex justify-end gap-1 mb-3 -mx-4">
            <RouterLink :to="{ name: 'projects.features.requirements.create', params: { feature_id: feature.id }}" class="btn btn-primary"><IconSet name="plus-lg" /> Add requirement</RouterLink>
            
            <DropdownMenu>
                <DropdownMenuItem :to="{ name: 'projects.features.edit', params: { feature_id: feature.id }}" icon="edit">Edit</DropdownMenuItem>
                <DropdownMenuItem @click="openFeatureDeleteModal" icon="trash" danger>Delete</DropdownMenuItem>
            </DropdownMenu>
        </div>

        <h3 class="font-semibold text-2xl mb-2"><a :href="'#feature_' + feature.id">{{ feature.name }}</a></h3>
        
        <RichText :markup="feature.description" class="mb-4" v-if="feature.description" />
        <p class="italic text-gray-400 mb-4" v-else>No description</p>

        <div class="space-y-8 mt-6">
            <RequirementItem :requirement="requirement" v-for="requirement in requirements" :key="requirement.id" />
        </div>
    </section>
</template>

<script>
import DropdownMenu from '@core/components/DropdownMenu.vue';
import DropdownMenuItem from '@core/components/DropdownMenuItem.vue';
import RichText from '@core/components/RichText.vue';
import RequirementItem from '@core/components/items/RequirementItem.vue';
import FeatureDelete from '@core/components/modals/FeatureDelete.vue';
import IconSet from '@core/components/IconSet.vue';
import { useModalStore } from '@core/stores';

export default {
    components: {
        DropdownMenu,
        DropdownMenuItem,
        IconSet,
        RichText,
        RequirementItem
    },
    computed: {
        project_has_users() {
            return !!this.feature.project.users.isNotEmpty();
        },
        is_active() {
            return this.$route.params.feature_id === this.feature.id;
        },
        is_filtered() {
            return this.feature.project.filters.has_features
                && this.feature.project.filters.features.includes(this.feature.id) === this.feature.project.filters.exclude_features;
        },
        requirements() {
            return this.feature.requirements.sortBy('id').sortBy('weight');
        },
    },
    data() {
        return {
            'highlight': false,
        };
    },
    methods: {
        openFeatureDeleteModal() {
            useModalStore().open(FeatureDelete, {feature: this.feature});
        },
    },
    mounted() { 
        if (this.is_active) {
            document.getElementById('feature_' + this.feature.id).scrollIntoView(true);
        }
        
        if (this.feature.was_recently_created) {
            this.highlight = true;

            setTimeout(() => {
                this.highlight = false;
            }, 3000);
        }
    },
    props: [
        'feature'
    ],
};
</script>
