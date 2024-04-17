<script setup>

    import VIcon from "@/Components/VIcon.vue";
    import {ChevronDownIcon, ChevronUpIcon} from "@heroicons/vue/24/outline";
    import VList from "@/Components/VList.vue";
    import VListItem from "@/Components/VListItem.vue";

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
        id: {
            type: String,
            default: ''
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
    <div
        class="select__input relative"
        aria-expanded="false" :aria-controls="`select__items-${name}`"
    >
        <div
            class="select__input-overlay border border-gray-200 rounded-t-md px-4 py-2 flex items-center justify-between gap-2 cursor-pointer hover:border-gray-400"
            @click="show = !show"
        >
            {{ placeholder }}

            <Transition>
                <v-icon :icon-component="show ? ChevronUpIcon : ChevronDownIcon" with-out-margin />
            </Transition>
        </div>

        <v-list
            v-if="show"
            role="listbox"
            :id="`select__items-${name}`"
            class="absolute top-[100%] left-0 bg-white w-full z-[9999] border-x border-b border-t-0 rounded-md"
            hover
        >
            <v-list-item
                role="option"
                v-for="item in items"
                :value="item[itemValue]"
                :key="item[itemValue]"
                class="bg-white border-b-0"
            >
                {{ item[itemLabel] }}
            </v-list-item>
        </v-list>
    </div>

</template>

<script>
    export default {
        data: () => {
            return {
                show: false
            }
        }
    }
</script>
