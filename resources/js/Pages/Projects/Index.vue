<script setup>
    import { Head } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import { PlusIcon } from '@heroicons/vue/24/outline';
    import VCard from "@/Components/VCard.vue";

    const props = defineProps({
        projects: {
            type: Array,
            required: true
        }
    });
</script>

<template>
    <Head title="Проекты" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800">Список проектов</h2>
                <primary-button
                    :prepend-icon="PlusIcon"
                    :href="route('projects.create')"
                >
                    Добавить проект
                </primary-button>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <v-card
                        v-for="project in projects"
                        :key="project.id"
                        :title="`№${project.id} - ${project.title}`"
                        :background-image="project.img"
                        :link="route('projects.show', project.id)"
                    >
                        <template #body>
                            <p>{{ project.description }}</p>
                            <p>Создатель: {{ project.creator.name }} ({{ project.creator.email }})</p>
                            <p>Дата создания: {{ project.created_at }}</p>
                        </template>
                    </v-card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
