<script setup>
    import {PlusIcon, XCircleIcon} from "@heroicons/vue/24/outline/index.js";
    import VIcon from "@/Components/VIcon.vue";
    import VAvatar from "@/Components/VAvatar.vue";
    import VListItem from "@/Components/VListItem.vue";
    import VSelect from "@/Components/VSelect.vue";
    import VModal from "@/Components/VModal.vue";
    import VList from "@/Components/VList.vue";
    import VCombobox from "@/Components/VCombobox.vue";

    const props = defineProps({
        items: {
            type: Array,
            required: true
        },
        project_id: {
            type: Number,
            required: true
        }
    });

    defineEmits([
       'updateProjectMembers',
       'excludeMember',
       'assignMember'
    ]);

</script>

<template>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center gap-2">
            Участники:
            <span class="flex space-x-[-15px]">
                <v-avatar
                    v-for="(member, key) in items"
                    class="border-2 border-white" :class="`z-[${items.length - key}]`"
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

    <v-modal
        v-model="addMembersModal"
        title="Добавление участника"
        body-classes="max-w-[650px]"
        :loading="loading"
    >
        <v-combobox
            class="mb-2"
            item-value="id"
            name="search-user"
            :items="users"
            v-model="selectedUser"
            @update:search="searchUsers"
        >
            <template #label="{ item }">
                {{ `${item.name} (${item.email})` }}
            </template>
        </v-combobox>

        <v-list
            :title="`${ items.length } ${ 'участник' + (items.length > 1 && items.length < 5 ? 'а' : (project.members.length > 5 ? 'ов' : ''))  }`"
        >
            <v-list-item
                v-for="member in items"
                class="border-b-0"
            >
                <div class="main-info flex items-center gap-3">
                    <v-avatar
                        class="w-[50px] h-[50px]"
                        :avatar-url="member.avatar_image"
                    ></v-avatar>
                    <p class="w-[15rem]">
                            <span class="font-semibold">
                                {{ member.user.name }}
                            </span>
                        <br>
                        <span class="text-sm text-gray-300">
                            {{ member.user.email }}
                            </span>
                    </p>
                </div>
                <div class="control-block grow flex items-center justify-end space-x-3">
                    <v-select
                        class="grow"
                        item-label="label"
                        item-value="value"
                        :items="typesMembers"
                        name="typesMember"
                        v-model="member.member_type"
                        @update:model-value="changeTypeMember(member.id, member.member_type)"
                    ></v-select>

                    <button
                        type="button"
                        class="text-[#ef4444]"
                        aria-label="Исключить участника"
                        @click="excludeMember(member.id)"
                    >
                        <v-icon :icon-component="XCircleIcon" class="h-6 w-6" />
                    </button>

                </div>
            </v-list-item>
        </v-list>
    </v-modal>

</template>

<script>
    import _ from "lodash";

    export default {
        data: () => {
            return {
                addMembersModal: false,
                typesMembers: [],
                loading: false,
                users: [],
                selectedUser: -1
            }
        },
        methods: {
            fetchMembers(url) {
                this.loading = true;
                /** обновляем Inertia, чтобы получить возможно новых участников */
                this.$inertia.reload();

                axios.get(url)
                    .then(response => {
                        this.typesMembers = response.data.types;
                        this.loading = false;
                    })
            },
            changeTypeMember(id, type) {
                this.loading = true;

                axios.patch(route('projects.member.changeType', {
                    member: id,
                    project: this.project_id,
                    member_type: type
                }))
                    .then(response => {
                        this.$emit('updateProjectMembers', { id: id, data: response.data.member });
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            searchUsers: _.debounce(function(query) {
                axios.get(route('search.user.findByString', { query: query }))
                        .then(response => {
                            this.users = response.data.users;
                        })
            }, 500),
            excludeMember: function (id) {
                axios.delete(route('projects.member.exclude', {
                    member: id,
                    project: this.project_id,
                }))
                    .then(() => {
                        this.$emit('excludeMember', id);
                    });
            },
            assignMember: function (user_id) {
                let formData = new FormData();
                formData.append('user_id', user_id);

                axios.post(route('projects.member.assign', this.project_id), formData)
                    .then(response => {
                        this.$emit('assignMember', response.data.member);
                    });
            }
        },
        watch: {
            addMembersModal: function (val) {
                if(val) {
                    this.fetchMembers(route('api.projects.loadTypesMember'))
                }
            },
            selectedUser: function (val) {
                this.assignMember(val);
            }
        }
    }
</script>
