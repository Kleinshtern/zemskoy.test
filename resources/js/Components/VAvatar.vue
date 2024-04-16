<script setup>
    const props = defineProps({
        avatarUrl: {
            type: String,
            required: false,
            default: "/img/avatar.png"
        },
        tooltipTitle: {
            type: String,
            required: false,
            default: ""
        }
    })
</script>

<template>
    <div
        class="w-[40px] h-[40px] rounded-full relative"
        :class="`${tooltipTitle ? 'tooltip' : ''}`"
    >
        <div
            v-if="tooltipTitle !== ''"
            class="tooltip__name absolute w-fit text-nowrap top-[-90%] left-[50%] translate-x-[-50%] transform z-[9999] bg-black/80 text-white px-3 rounded-md"
        >
            {{ tooltipTitle }}
        </div>
        <img :src="avatarUrl" alt="avatar">
    </div>
</template>

<style scoped lang="scss">
    .tooltip {
        cursor: pointer;

        .tooltip__name {
            @apply invisible;

            &:after {
                content:'';
                position: absolute;
                left: 0;
                right: 0;
                top: 100%;
                margin: 0 auto;
                width: 0;
                height: 0;
                border-top: 5px solid rgba(0, 0, 0, .8);
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
            }
        }

        &:hover .tooltip__name {
            @apply visible;
        }
    }
</style>

