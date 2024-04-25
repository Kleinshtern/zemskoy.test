<script setup>
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {Head} from "@inertiajs/vue3";
    import VBreadcrumbs from "@/Components/VBreadcrumbs.vue";
    import { Link } from '@inertiajs/vue3';
    import VIcon from "@/Components/VIcon.vue";
    import {PencilIcon, XMarkIcon, HeartIcon} from "@heroicons/vue/24/outline";
    import VTasksList from "@/Components/VTasksList.vue";
    import VAvatar from "@/Components/VAvatar.vue";
    import Members from "@/Pages/Projects/Blocks/Members.vue";

    const props = defineProps({
        project: {
            type: Object,
            required: true
        },
        todoTasks: {
            type: Array,
            required: true
        },
        inProgressTasks: {
            type: Array,
            required: true
        },
        doneTasks: {
            type: Array,
            required: true
        }
    });

    const breadcrumbs = [
        { key: "Dashboard", title: "Главная", route: route('dashboard') },
        { key: "Projects", title: "Проекты", route: route('projects.index') },
        { key: "Project Detail", title: props.project.title }
    ]
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="project.title" />

        <template #breadcrumbs>
            <v-breadcrumbs
                :breadcrumbs="breadcrumbs"
            />
        </template>
        <template #header>
            <div class="relative min-h-[300px] flex flex-col md:flex-row justify-center items-center">
                <div
                    class="min-h-[300px] w-full border border-b-0 md:border-r-0 md:w-[85%] bg-no-repeat bg-cover rounded-t-xl md:rounded-3xl md:rounded-r-none"
                    :style="`background-image: ${ project.img ? `url(/${project.img})` : '#e4f4de' }`"
                ></div>

                <div
                    class="md:min-h-[300px] w-full md:w-[15%] bg-white border rounded-b-lg md:rounded-r-3xl md:rounded-bl-none flex items-start justify-center p-3"
                >
                    <div class="button-group inline-flex space-x-4">
                        <Link :href="route('projects.edit', project.id)" class="border border-gray-300 text-gray-300 p-2 rounded-full hover:text-gray-500 hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition duration-150 ease-in-out">
                            <v-icon :icon-component="PencilIcon" with-out-margin />
                        </Link>
                        <Link :href="route('projects.edit', project.id)" class="border border-gray-300 text-gray-300 p-2 rounded-full hover:text-gray-500 hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition duration-150 ease-in-out">
                            <v-icon :icon-component="HeartIcon" with-out-margin />
                        </Link>
                        <Link :href="route('projects.destroy', project.id)" class="border border-[#ef4444] text-[#ef4444] p-2 rounded-full hover:text-[#450a0a] hover:bg-[#ef4444] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ef4444] transition duration-150 ease-in-out">
                            <v-icon :icon-component="XMarkIcon" with-out-margin />
                        </Link>
                    </div>
                </div>

                <div class="absolute text-center mx-20 left-0 right-0 px-5 py-3 bg-white rounded-lg shadow-md">
                    <h1 class="font-semibold text-3xl text-[#050042]">{{ project.title }}</h1>
                </div>
            </div>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center gap-2">
                Создатель проекта:
                <span class="flex items-center gap-2">
                    <v-avatar
                        class="border-2 border-white"
                    ></v-avatar>
                    <b>{{ project.creator.name }} ({{ project.creator.email }})</b>
                </span>
            </div>
        </div>

        <members
            :items="project.members"
            :project_id="project.id"
            @updateProjectMembers="updateMembersList"
            @assignMember="addNewMemberToList"
            @excludeMember="removeMemberFromList"
        />

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <v-tasks-list
                        title-list="Список задач"
                        :tasks="todoTasks"
                        :project-id="project.id"
                    ></v-tasks-list>
                    <v-tasks-list
                        title-list="В работе"
                        :tasks="inProgressTasks"
                        :project-id="project.id"
                        hide-default-footer
                    ></v-tasks-list>
                    <v-tasks-list
                        title-list="Завершены"
                        :tasks="doneTasks"
                        :project-id="project.id"
                        hide-default-footer
                    ></v-tasks-list>
                </div>
            </div>
        </div>



    </AuthenticatedLayout>
</template>

<script>
    export default {
        data: () => {
            return {}
        },
        methods: {
            updateMembersList: function (values) {
                let idx = this.project.members.findIndex(member => member.id === values.id);
                if(idx !== -1) {
                    this.project.members[idx] = values.data;
                }
            },
            addNewMemberToList: function (value) {
                this.project.members.push(value);
            },
            removeMemberFromList: function (id) {
                let idx = this.project.members.findIndex(member => member.id === id);
                if(idx !== -1) {
                    this.project.members.splice(idx, 1);
                }
            }
        }
    }
</script>
