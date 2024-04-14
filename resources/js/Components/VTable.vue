<script setup>
    const props = defineProps({
        headers: {
            type: Array,
            required: false,
            default: []
        },
        items: {
            type: Array,
            required: true
        },
        itemKey: {
            type: String,
            required: true
        },
        canEdit: {
            type: Boolean,
            required: false,
            default: true
        }
    })
</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-blue-500 dark:text-blue-400">
            <thead class="text-xs text-gray-700 uppercase bg-blue-200 dark:text-blue-400">
            <tr>
                <template v-if="headers.length > 0">
                    <th
                        scope="col"
                        class="px-6 py-3"
                        v-for="header in headers"
                        :key="header.key"
                    >
                        {{ header.title }}
                    </th>
                </template>
                <template v-else>
                    <th
                        scope="col"
                        class="px-6 py-3"
                        v-for="header in Object.keys(items[0])"
                        :key="header"
                    >
                        {{ header }}
                    </th>
                </template>
                <th scope="col" class="px-6 py-3" v-if="canEdit">
                    <span class="sr-only">Редатировать</span>
                </th>
            </tr>
            </thead>
            <tbody>
                <tr
                    class="bg-white border-b dark:bg-blue-100 dark:border-blue-300 hover:bg-blue-50 dark:hover:bg-blue-200"
                    v-for="item in items"
                    :key="item[itemKey]"
                >
                    <template v-if="headers.length > 0">
                        <td
                            class="px-6 py-4 text-blue-900"
                            v-for="header in headers"
                            :key="header.key"
                        >
                            <slot :name="`item.${header.key}`" :raw="item[header.key]">
                                {{ item[header.key] }}
                            </slot>
                        </td>
                    </template>
                    <template v-else>
                        <td
                            class="px-6 py-4 text-blue-900"
                            v-for="header in Object.keys(items[0])"
                            :key="header"
                        >
                            {{ item[header] }}
                        </td>
                    </template>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Редактировать</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
