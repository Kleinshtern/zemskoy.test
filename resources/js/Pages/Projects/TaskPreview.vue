<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import VBreadcrumbs from "@/Components/VBreadcrumbs.vue";

import {OnClickOutside} from "@vueuse/components";

const props = defineProps({
    task: {
        type: Object,
        required: true
    },
    project: {
        type: Object,
        required: true
    }
});

const breadcrumbs = [
    {key: "Dashboard", title: "Главная", route: route('dashboard')},
    {key: "Projects", title: "Проекты", route: route('projects.index')},
    {key: "Project Detail", title: props.project.title, route: route('projects.show', props.project.id)},
    {key: "Task Detail", title: props.task.title}
]
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="task.title"/>

        <template #breadcrumbs>
            <v-breadcrumbs
                :breadcrumbs="breadcrumbs"
            />
        </template>
        <template #header>
            <span class="text-sm text-gray-400">{{ project.title }}</span>
            <h1 class="text-2xl font-semibold">
                <template v-if="editableTaskTitle.status">
                    <OnClickOutside @trigger="saveTitleTask">
                        <input
                            type="text"
                            class="outline-none bg-gray-200 focus:bg-gray-300"
                            v-model="editableTaskTitle.model"
                            autofocus
                            @keydown.enter="saveTitleTask"
                        >
                    </OnClickOutside>
                </template>
                <template v-else>
                    <span class="hover:bg-gray-200 cursor-pointer"
                          @click="editableTaskTitle.status = true"
                    >
                        {{ editableTaskTitle.model }}
                    </span>
                </template>
            </h1>
        </template>
    </AuthenticatedLayout>
</template>

<script>
export default {
    data: () => {
        return {
            editableTaskTitle: {
                status: false,
                model: ''
            }
        }
    },
    mounted() {
        this.editableTaskTitle.model = this.task.title;
    },
    methods: {
        saveTitleTask: function () {
            this.editableTaskTitle.status = false;

            axios.patch(route('projects.task.changeTitle', {
                project: this.project.id,
                task: this.task.id,
                title: this.editableTaskTitle.model
            }))
                .then((response) => {
                    this.task.title = response.data.newTitle;
                })
        }
    }
}
</script>
