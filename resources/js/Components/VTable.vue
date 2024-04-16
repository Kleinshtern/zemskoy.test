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
        }
    })
</script>

<template>
    <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-[#050042]">
            <thead class="text-xs text-[#050042] uppercase bg-[#b9e6a6]">
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
            </tr>
            </thead>
            <tbody>
                <tr
                    class="bg-white border-b border-[#e4f4de] hover:bg-[#e4f4de]"
                    v-for="item in items"
                    :key="item[itemKey]"
                >
                    <template v-if="headers.length > 0">
                        <td
                            class="px-6 py-4 text-[#050042]"
                            v-for="header in headers"
                            :key="header.key"
                        >
                            <slot :name="`item.${header.key}`" :raw="item[header.key]" :root="item">
                                {{ item[header.key] }}
                            </slot>
                        </td>
                    </template>
                    <template v-else>
                        <td
                            class="px-6 py-4 text-[#050042]"
                            v-for="header in Object.keys(items[0])"
                            :key="header"
                        >
                            {{ item[header] }}
                        </td>
                    </template>
                </tr>
            </tbody>
        </table>
    </div>
</template>
