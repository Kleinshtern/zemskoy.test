<script setup>
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {Head} from "@inertiajs/vue3";
    import VBreadcrumbs from "@/Components/VBreadcrumbs.vue";
    import { Link } from '@inertiajs/vue3';
    import VIcon from "@/Components/VIcon.vue";
    import {PencilIcon, XMarkIcon, HeartIcon, PlusIcon, XCircleIcon} from "@heroicons/vue/24/outline";
    import VTasksList from "@/Components/VTasksList.vue";
    import VAvatar from "@/Components/VAvatar.vue";
    import VModal from "@/Components/VModal.vue";
    import VList from "@/Components/VList.vue";
    import VListItem from "@/Components/VListItem.vue";
    import VSelect from "@/Components/VSelect.vue";

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
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center gap-2">
                Участники:
                <span class="flex space-x-[-15px]">
                    <v-avatar
                        v-for="(member, key) in project.members"
                        class="border-2 border-white" :class="`z-[${project.members.length - key}]`"
                        :avatar-url="member.avatar_image"
                        :tooltip-title="`${member.user.name} (${member.user.email})`"
                    ></v-avatar>
                    <button
                        class="w-[40px] h-[40px] border-2 border-dashed border-gray-200 text-gray-200 rounded-full bg-white hover:border-gray-400 hover:text-gray-400 transition flex items-center justify-center"
                        type="button"
                        @click="addMembersModal = true"
                    >
                        <v-icon
                            :icon-component="PlusIcon"
                            with-out-margin
                        />
                    </button>
                </span>
            </div>
        </div>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <v-tasks-list
                        title-list="Список задач"
                        :tasks="todoTasks"></v-tasks-list>
                    <v-tasks-list
                        title-list="В работе"
                        :tasks="inProgressTasks"></v-tasks-list>
                    <v-tasks-list
                        title-list="Завершены"
                        :tasks="doneTasks"></v-tasks-list>
                </div>
            </div>
        </div>

        <v-modal
            v-model="addMembersModal"
            title="Добавление участника"
            body-classes="max-w-[650px]"
        >
            <v-list
                :title="`${ project.members.length } ${ 'участник' + (project.members.length > 1 && project.members.length < 5 ? 'а' : (project.members.length > 5 ? 'ов' : ''))  }`"
            >
                <v-list-item
                    v-for="member in project.members"
                    class="border-b-0 justify-between"
                >
                    <div class="main-info flex items-center gap-3">
                        <v-avatar
                            class="w-[50px] h-[50px]"
                            :avatar-url="member.avatar_image"
                        ></v-avatar>
                        <p>
                        <span class="font-semibold">
                            {{ member.user.name }}
                        </span>
                            <br>
                            <span class="text-sm text-gray-300">
                            {{ member.user.email }}
                        </span>
                        </p>
                    </div>
                    <div class="control-block flex items-center justify-end space-x-3">
                        <v-select
                            item-label="label"
                            item-value="value"
                            :items="typesMembers"
                            name="typesMember"
                            :model-value="member.member_type"
                        ></v-select>

                        <button type="button" class="text-[#ef4444]">
                            <v-icon :icon-component="XCircleIcon" class="h-6 w-6" />
                        </button>

                    </div>
                </v-list-item>
            </v-list>
        </v-modal>

    </AuthenticatedLayout>
</template>

<script>
    export default {
        data: () => {
            return {
                addMembersModal: false,
                typesMembers: []
            }
        },
        methods: {
            fetchMembers(url) {
                this.$inertia.reload();

                axios.get(url)
                    .then(response => {
                        /** обновляем Inertia, чтобы получить возможно новых участников */
                        this.typesMembers = response.data.types;
                    })
            }
        },
        watch: {
            addMembersModal: function (val) {
                if(val) {
                    this.fetchMembers(route('api.projects.loadTypesMember'))
                }
            }
        }
    }
</script>
