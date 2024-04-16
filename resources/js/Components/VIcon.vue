<script setup>
    defineProps({
        iconComponent: {
            required: true
        },
        withOutMargin: {
            type: Boolean,
            required: false,
            default: false
        }
    })
</script>

<template>
    <component :is="iconComponent" class="h-5 w-5" :class="`${withOutMargin ? '' : 'mr-2'}`"></component>
</template>
