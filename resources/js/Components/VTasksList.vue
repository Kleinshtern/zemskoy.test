<script setup>
    import VDivider from "@/Components/VDivider.vue";
    import VIcon from "@/Components/VIcon.vue";
    import {CalendarIcon, PlusIcon} from "@heroicons/vue/24/outline";
    import VBadge from "@/Components/VBadge.vue";
    import VAvatar from "@/Components/VAvatar.vue";

    const props = defineProps({
        titleList: {
            type: String,
            required: false,
            default: "Task list"
        },
        tasks: {
            type: Array,
            required: false,
            default: []
        }
    })
</script>

<template>
    <div class="w-full bg-[#f5f5f7] border border-[#f5f5f7] rounded-lg pb-5">
        <div class="px-5 py-3 font-bold text-xl text-[#050042]">
            {{ titleList }} <span class="rounded-md bg-[#e2e1f0] px-2">{{ tasks.length }}</span>
        </div>
        <div class="flex flex-col items-center space-y-2">
            <div
                class="w-[90%] border border-gray-200 rounded-lg bg-white px-2 py-3 shadow"
                 v-for="task in tasks" :key="task.id"
            >
                <p class="font-semibold text-[#050042]">{{ task.title }}</p>

                <div class="contributors flex items-start justify-between my-2">
                    <v-badge
                        :title="task.task_type.display_name"
                        :bg-color="task.task_type.hex_color"
                        class="text-[#050042]"
                    ></v-badge>

                    <v-avatar
                        class="border-2 border-white"
                        :tooltip-title="`${task.creator.name} (${task.creator.email})`"
                    ></v-avatar>
                </div>

                <v-divider class="my-4 bg-gray-200" />
                <span class="flex justify-end items-center text-gray-400 font-semibold">
                    <v-icon
                        :icon-component="CalendarIcon"
                        with-out-margin
                    />
                    {{ task.created_at }}
                </span>
            </div>
            <button
                type="button"
                class="w-[90%] border border-gray-200 bg-[#eeeef0] rounded-lg px-2 py-3 font-semibold flex justify-center items-center gap-2 hover:bg-[#dcdcdc] transition"

            >
                <v-icon :icon-component="PlusIcon" with-out-margin />
                Добавить задачу
            </button>
        </div>
    </div>
</template>
