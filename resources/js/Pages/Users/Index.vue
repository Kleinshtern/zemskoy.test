<script setup>
    import {Head} from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import VTable from "@/Components/VTable.vue";

    const props = defineProps({
        users: {
            type: Array,
            required: true
        }
    })

    const headers = [
        { key: 'id', title: 'ID' },
        { key: 'name', title: 'Имя' },
        { key: 'email', title: 'E-mail' },
        { key: 'created_at', title: 'Дата регистрации' },
    ]

</script>

<template>
    <Head title="Пользователи" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список пользователей</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <v-table
                        item-key="id"
                        :items="users"
                        :headers="headers"
                    >
                        <template #item.name="{ raw }">
                            <b>{{ raw }}</b>
                        </template>
                    </v-table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
