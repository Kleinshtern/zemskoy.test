<script setup>
    import {ChevronLeftIcon} from "@heroicons/vue/24/outline/index.js";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import InputError from "@/Components/InputError.vue";
    import TextInput from "@/Components/TextInput.vue";
    import SecondaryButton from "@/Components/SecondaryButton.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {useForm} from "@inertiajs/vue3";

    const props = defineProps({
        project: {
            type: Object,
            required: true
        }
    });

    const submit = () => {
        form.put(route('projects.update', form.id))
    }

    const form = useForm({
        id: props.project.id,
        title: props.project.title,
        description: props.project.description,
    })

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-3">
                <primary-button :href="route('projects.show', project.id)">
                    <ChevronLeftIcon class="h-5 w-5"></ChevronLeftIcon>
                    Вернуться
                </primary-button>
                <h2 class="font-semibold text-xl text-gray-800">Редактирование проекта</h2>
            </div>
        </template>
        <form @submit.prevent="submit">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12">

                        <div class="mb-5">
                            <InputLabel for="title" value="Название проекта *" class="block text-sm font-medium leading-6 text-gray-900 pb-2" />

                            <TextInput
                                id="title"
                                type="text"
                                v-model="form.title"
                                autofocus
                                required
                                autocomplete="title"
                            />

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div class="mb-5">
                            <InputLabel for="description" value="Описание" class="block text-sm font-medium leading-6 text-gray-900 pb-2" />

                            <TextInput
                                id="description"
                                type="text"
                                v-model="form.description"
                                autofocus
                                autocomplete="description"
                            />

                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <secondary-button type="submit">
                            Сохранить
                        </secondary-button>

                    </div>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
