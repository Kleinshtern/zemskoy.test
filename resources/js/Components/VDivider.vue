<script setup>
    const props = defineProps({
        height: {
            type: Number,
            required: false,
            default: 1
        }
    });
</script>

<template>
    <span class="divider__block" :style="styles"></span>
</template>

<script>
    export default {
        computed: {
            styles: function () {
                return {
                    '--divider__height': this.height + 'px',
                }
            }
        }
    }
</script>

<style scoped>
    .divider__block {
        display: block;
        height: var(--divider__height);
    }
</style>
