<script setup>
    import { Head } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import VTable from "@/Components/VTable.vue";

    const props = defineProps({
        projects: {
            type: Array,
            required: true
        }
    });

    const headers = [
        { key: 'id', title: 'ID' },
        { key: 'title', title: 'Название' },
        { key: 'description', title: 'Описание' },
        { key: 'creator', title: 'Создатель' },
        { key: 'created_at', title: 'Дата создания' }
    ]
</script>

<template>
    <Head title="Проекты" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список проектов</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <v-table
                        item-key="id"
                        :items="projects"
                        :headers="headers"
                    >
                        <template #item.creator="{ raw }">
                            {{ raw.name }} ({{ raw.email }})
                        </template>
                    </v-table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
