<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    content: "",
});

const props = defineProps({
    errors: Object,
});
</script>

<template>
    <Head title="New Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Post
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="form.post(route('posts.store'))">
                            <div>
                                <div>
                                    <label
                                        for="name"
                                        class="block font-medium text-sm text-gray-700"
                                    >
                                        Name
                                    </label>
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        id="name"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    />
                                    <div
                                        v-if="errors.name"
                                        class="text-red-600"
                                    >
                                        {{ errors.name }}
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label
                                        for="content"
                                        class="block font-medium text-sm text-gray-700"
                                    >
                                        Content
                                    </label>
                                    <textarea
                                        v-model="form.content"
                                        id="content"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    ></textarea>
                                    <div
                                        v-if="errors.content"
                                        class="text-red-600"
                                    >
                                        {{ errors.content }}
                                    </div>
                                </div>
                            </div>

                            <div class="py-4">
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="inline-block px-4 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded"
                                >
                                    Save post
                                </button>
                                <Link
                                    :href="route('posts.index')"
                                    class="ml-2 inline-block px-4 py-3 bg-gray-100 hover:bg-gray-200 rounded"
                                >
                                    Cancel
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
