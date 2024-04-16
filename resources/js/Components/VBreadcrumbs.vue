<script setup>

    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        breadcrumbs: {
            type: Array,
            required: true
        }
    })
</script>

<template>
    <div class="breadcrumbs text-sm text-gray-600 flex gap-2 pb-5">
        <div
            class="breadcrumb flex gap-2"
            v-for="(breadcrumb, key) in breadcrumbs"
            :key="breadcrumb.key"
        >
            <div class="breadcrumb__link" v-if="breadcrumb.route">
                <Link :href="breadcrumb.route" class="text-gray-600 hover:text-gray-900 font-semibold">
                    {{ breadcrumb.title }}
                </Link>
            </div>
            <div class="breadcrumb__default" v-else>
                {{ breadcrumb.title }}
            </div>

            <span v-if="breadcrumbs.length !== (key + 1)">/</span>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
