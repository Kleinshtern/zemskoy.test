<script setup>
    import VList from "@/Components/VList.vue";
    import VListItem from "@/Components/VListItem.vue";

    const props = defineProps({
        modelValue: {
            type: [Array, String, Number],
            required: true
        },
        placeholder: {
            type: String,
            default: "Начните ввод..."
        },
        name: {
            type: String,
            required: true
        },
        items: {
            type: Array,
        },
        itemValue: {
            type: String,
            required: true
        },
        itemLabel: {
            type: String
        }
    });

    defineEmits([
        'update:search',
        'update:modelValue'
    ]);

</script>

<template>
    <div class="combobox__layout relative">
        <input
            class="block w-full rounded-t-md border-0 py-4 px-2 text-gray-900 bg-gray-100 outline-0 placeholder:text-gray-400 focus:bg-gray-200"
            type="search"
            v-model="searchQuery"
            @input="$emit('update:search', $event.target.value)"
            @focus="showList = true"
            :placeholder="placeholder"
        >

        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <v-list
                v-if="items.length > 0 && showList"
                role="listbox"
                :id="`select__items-${name}`"
                class="absolute top-[100%] left-0 bg-white w-full z-[9999] border max-h-[350px] overflow-auto"
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
                    <slot name="label" :item="item">
                        {{ item[itemLabel] }}
                    </slot>
                </v-list-item>
            </v-list>
        </Transition>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                showList: false,
                searchQuery: ''
            }
        },
        methods: {
            selectValue: function (value) {
                this.$emit('update:modelValue', value);
                this.showList = false;
            }
        }
    }
</script>
