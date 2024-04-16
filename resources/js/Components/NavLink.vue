<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center rounded-xl px-5 pt-2 pb-2 text-sm font-medium text-white bg-[#5280e2] transition duration-150 ease-in-out'
        : 'inline-flex items-center rounded-xl px-5 pt-2 pb-2 border-b-2 border-transparent text-sm font-medium text-[#658479] hover:text-white hover:bg-[#5280e2] transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
