<template>
    <DefaultLayout>
        <ErrorMessage icon="question" title="Not found">
            The resource you are looking for cannot be found.
        </ErrorMessage>
    </DefaultLayout>
</template>

<script>
import ErrorMessage from '@core/components/ErrorMessage.vue';
import DefaultLayout from '@core/components/layouts/DefaultLayout.vue';

export default {
    components: {
        ErrorMessage,
        DefaultLayout,
    },
};
</script>
