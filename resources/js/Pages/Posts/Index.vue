<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { onMounted, computed, ref } from "vue";

const props = defineProps({
    posts: Object,
    flash: Object,
});

const isVisible = ref(true);
const message = computed(() => props.flash.message);

const destroy = (id) => {
    if (confirm("Are you sure?")) {
        router.delete(route("posts.destroy", id));
        scheduleHide();
    }
};

const scheduleHide = () => {
    isVisible.value = true;
    setTimeout(() => {
        isVisible.value = false;
    }, 3000);
};

onMounted(() => {
    scheduleHide();
});
</script>

<template>
    <Head title="Posts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <Transition name="message" appear>
                            <div
                                v-if="message && isVisible"
                                class="bg-green-500 text-white font-bold p-4 rounded-md fixed bottom-4 right-4 z-50 shadow-lg shadow-green-400/80"
                            >
                                {{ message }}
                            </div>
                        </Transition>
                        <Link
                            :href="route('posts.create')"
                            class="inline-block px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded mb-4"
                            >Add new post</Link
                        >

                        <table
                            class="mt-4 min-w-full divide-y divide-gray-200 border"
                        >
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span
                                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                            >ID</span
                                        >
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span
                                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                            >Name</span
                                        >
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span
                                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                            >Content</span
                                        >
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span
                                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                            >Actions</span
                                        >
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="bg-white divide-y divide-gray-200 divide-solid"
                            >
                                <TransitionGroup name="list">
                                    <tr v-for="post in posts" :key="post.id">
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900"
                                        >
                                            {{ post.id }}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-nowrap text-sm leading-5 text-gray-900"
                                        >
                                            {{ post.name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900"
                                        >
                                            {{ post.content }}
                                        </td>

                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900"
                                        >
                                            <div class="flex">
                                                <Link
                                                    :href="
                                                        route(
                                                            'posts.edit',
                                                            post.id
                                                        )
                                                    "
                                                    class="px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded font-bold uppercase mr-2"
                                                    >Edit</Link
                                                >
                                                <button
                                                    @click="destroy(post.id)"
                                                    type="button"
                                                    class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded font-bold uppercase"
                                                >
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </TransitionGroup>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.message-enter-active,
.message-leave-active {
    transition: all 0.5s ease-in;
}

.message-enter-from,
.message-leave-to {
    opacity: 0;
    transform: scale(0) translateY(500px);
}

.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter,
.list-leave-to {
    opacity: 0;
}
</style>
