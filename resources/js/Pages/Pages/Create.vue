<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    langs: {
        type: Object,
        default: {}
    },
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    let settingsForm = document.getElementById("form");
    let formData = new FormData(settingsForm);
    const data = {};
    // need to convert it before using not with XMLHttpRequest
    for (let [key, val] of formData.entries()) {
        Object.assign(data, { [key]: val });
    }

    form.post(route("pages.store", data), {
        preserveScroll: true,
    });
};

</script>

<template>
    <Head title="Create Page" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Page</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">


                        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                            {{ status }}
                        </div>


                        <form @submit.prevent="submit" id="form">

                            <div v-for="(lang, index) in langs" :key="lang">
                                <div>
                                    <div>{{ lang }}</div>
                                    <div v-if="form.errors" class="mb-4 font-medium text-sm text-red-600">
                                        {{ form.errors }}
                                    </div>
                                    <div>
                                        <div class="border rounded-md p-4 mb-4">
                                            <InputLabel for="title" :value="'Title (' + lang + ')'" />
                                            <input type="text" :name="'title:' +lang"
                                                :placeholder="'Title (' + lang + ')'" class="block w-full" />
                                            <InputError class="mt-2" :message="form.errors.title" />
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Add
                            </PrimaryButton>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>