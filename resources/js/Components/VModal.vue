<script setup>
    import VDivider from "@/Components/VDivider.vue";
    import VIcon from "@/Components/VIcon.vue";
    import {XCircleIcon} from "@heroicons/vue/24/outline";

    const props = defineProps({
       modelValue: {
           type: Boolean,
           required: false,
           default: false
       },
       title: {
           type: String,
           required: false,
           default: "Modal Title"
       },
       bodyClasses: {
           type: String,
           required: false,
       }
    });
</script>

<template>
    <div
        class="modal__window fixed top-0 left-0 w-full h-full"
        :class="`${ modelValue ? 'shown' : 'not__shown' }`"
    >
        <div
            class="modal__window_overflow absolute top-0 left-0 bg-black/50 w-full h-full"
            @click="$emit('update:modelValue', false)"
        ></div>

        <div
            class="modal__window_body absolute z-10 bg-white h-[50%] top-0 left-0 right-0 bottom-0 my-auto mx-auto rounded-lg shadow-md"
            :class="bodyClasses"
        >
            <div class="modal__window_title h-[54px] px-4 py-2 flex items-center justify-between font-semibold">
                <span class="title">
                    {{ title }}
                </span>
                <button
                    type="button"
                    @click="$emit('update:modelValue', false)"
                >
                    <v-icon
                        class="h-6 w-6"
                        :icon-component="XCircleIcon"
                        with-out-margin
                    />
                </button>
            </div>

            <v-divider class="bg-gray-300" />

            <div class="modal__window_content px-4 py-2 w-full">
                <slot />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        watch: {
            modelValue: function (val) {
                if(val) {
                    document.body.style.overflowY = "hidden";
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    .modal__window {
        &.shown {
            display: block;
        }
        &.not__shown {
            display: none;
        }
    }
</style>
