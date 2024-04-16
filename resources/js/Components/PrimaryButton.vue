<script setup>
    import VIcon from "@/Components/VIcon.vue";

    defineProps({
        href: {
            type: String,
            required: true
        },
        prependIcon: {
            required: false,
            default: null
        }
    })
</script>

<template>
    <a
        class="inline-flex items-center px-4 py-2 bg-[#e5ecfb] border border-transparent rounded-md font-semibold text-xs text-[#5280e2] uppercase tracking-widest hover:bg-[#5280e2] hover:text-white focus:bg-[#5280e2] active:bg-[#5280e2] focus:outline-none focus:ring-2 focus:ring-[#5280e2] focus:ring-offset-2 transition ease-in-out duration-150"
        :href="href"
    >
        <template v-if="prependIcon">
            <v-icon :icon-component="prependIcon" />
        </template>
        <slot />
    </a>
</template>
