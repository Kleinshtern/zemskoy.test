<script setup>

    import VIcon from "@/Components/VIcon.vue";
    import {ChevronDownIcon, ChevronUpIcon} from "@heroicons/vue/24/outline";
    import VList from "@/Components/VList.vue";
    import VListItem from "@/Components/VListItem.vue";

    import { OnClickOutside } from "@vueuse/components";

    const props = defineProps({
        modelValue: {
            type: [Array, String, Number],
            required: true
        },
        multiple: {
            type: Boolean,
            default: false
        },
        placeholder: {
            type: String,
            default: "Выберите вариант из списка"
        },
        name: {
            type: String,
            required: true
        },
        items: {
            type: Array,
            required: true
        },
        itemValue: {
            type: String,
            required: true
        },
        itemLabel: {
            type: String,
            required: true
        }
    });

</script>

<template>
    <onClickOutside @trigger="show = false">
        <div
            class="select__input relative"
            :aria-expanded="show" :aria-controls="`select__items-${name}`"
        >
            <div
                class="select__input-overlay border border-gray-200 rounded-t-md px-2 py-2 flex items-center justify-between gap-2 cursor-pointer hover:border-gray-400"
                :class="`${ show ? 'active' : '' }`"
                @click="show = !show"
            >
                <template v-if="typeof modelValue === Array.prototype">
                    is array
                </template>
                <template v-else-if="modelValue !== null">
                    <section v-if="items.length > 0">
                        {{ items.find(item => item[itemValue] === modelValue)[itemLabel] }}
                    </section>
                </template>
                <template v-else>
                    {{ placeholder }}
                </template>

            <Transition>
                <v-icon :icon-component="show ? ChevronUpIcon : ChevronDownIcon" with-out-margin />
            </Transition>
        </div>

            <Transition
                enter-active-class="transition ease-out duration-200"
                enter-from-class="opacity-0 scale-95"
                enter-to-class="opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="opacity-100 scale-100"
                leave-to-class="opacity-0 scale-95"
            >
                <v-list
                    v-if="show"
                    role="listbox"
                    :id="`select__items-${name}`"
                    class="absolute top-[100%] left-0 bg-white w-full z-[9999] border-x border-b border-t-0"
                    hover
                >
                    <v-list-item
                        role="option"
                        v-for="item in items"
                        :value="item[itemValue]"
                        :key="item[itemValue]"
                        class="bg-white border-b-0"
                        @click="selectValue(item[itemValue])"

                    >
                        {{ item[itemLabel] }}
                    </v-list-item>
                </v-list>
            </Transition>
        </div>
    </onClickOutside>
</template>

<script>
    export default {
        data: () => {
            return {
                show: false
            }
        },
        emits: [
            'update:modelValue'
        ],
        methods: {
            selectValue: function (value) {
                this.$emit('update:modelValue', value);
                this.show = !this.show;
            }
        }
    }
</script>

<style scoped>
    .select__input {
        .select__input-overlay {
            &.active {
                --tw-border-opacity: 1;
                border-color: rgb(156 163 175 / var(--tw-border-opacity))
            }
        }
    }
</style>
