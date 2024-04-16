<script setup>
    const props = defineProps({
        title: {
            type: String,
            required: false,
            default: "Badge"
        },
        bgColor: {
            type: String,
            required: false,
            default: "#eeeef0"
        }
    })
</script>

<template>
    <span
        class="block rounded-md text-center w-fit px-2"
        :style="`background-color: ${bgColor}`">
        <slot>
            {{ title }}
        </slot>
    </span>
</template>
