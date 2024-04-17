<script setup>
    const props = defineProps({
        hover: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: ''
        }
    })
</script>

<template>
    <ul class="list__items list-none rounded-t-sm"
        :class="hover ? 'list__hover' : ''">

        <li
            v-if="title"
            class="list__title text-sm text-gray-300 border-b pb-3"
        >
            {{ title }}
        </li>

        <slot />
    </ul>
</template>

<style lang="scss">
    .list__items {
        &.list__hover {
            .list__item:hover {
                cursor: pointer;
                background: lightgray;
            }
        }

    }
</style>
