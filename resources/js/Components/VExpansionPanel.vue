<script setup>
    import { ChevronRightIcon, ChevronDownIcon } from '@heroicons/vue/24/outline';
    import VIcon from "@/Components/VIcon.vue";
    import VDivider from "@/Components/VDivider.vue";

    const props = defineProps({
       title: {
           type: String,
           required: false,
           default: 'ExpansionPanel'
       }
    });
</script>

<template>
    <div class="shadow-md expansion-panel" :style="heightBody">
        <div
            class="expansion-panel__header"
            :class="show ? 'active' : ''"
            @click="show = !show"
        >
            <slot name="title">
                {{ title }}
            </slot>
            <v-icon :icon-component="show ? ChevronDownIcon : ChevronRightIcon"></v-icon>

        </div>

        <v-divider v-if="show" />

        <div class="expansion-panel__body" :class="show ? 'visible' : 'hide'">
            <slot name="body">
                ExpansionPanelContent
            </slot>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                show: false,
                heightBody: 0
            }
        },
        mounted() {
            let height = document.getElementsByClassName('expansion-panel__body')[0].scrollHeight + 20;

            this.heightBody = {
                '--expansion-panel__body-height': height + 'px'
            }
        }
    }
</script>

<style scoped lang="scss">
    .expansion-panel {

        margin-bottom: 10px;

        background: white;
        border-radius: 10px;

        display: flex;
        flex-direction: column;

        .expansion-panel__header {
            min-height: 54px;
            font-size: 1.2em;

            border-radius: 10px;
            padding: 10px 15px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            &.active {
                background: rgb(219 234 254);
            }

            &:hover {
                cursor: pointer;
                background: rgb(219 234 254);
            }
        }

        .expansion-panel__body {
            transition-property: max-height, padding;
            transition-duration: .2s;
            transition-timing-function: ease-in-out;

            &.hide {
                padding: 0;
                max-height: 0;
                overflow: hidden;
            }

            &.visible {
                max-height: var(--expansion-panel__body-height);
                padding: 10px 15px;
            }
        }
    }
</style>
