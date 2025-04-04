<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-1">
            <div class="mx-auto max-w-12xl sm:px-6 lg:px-8">
                <!-- Main Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Sales Report -->
                    <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-lg">

                    </div>

                    <!-- Statistics Panel -->
                    <div class="bg-white p-6 rounded-lg shadow-lg">

                    </div>
                </div>

                <!-- Secondary Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div class="bg-white p-6 rounded-lg shadow-lg">

                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">

                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">

                    </div>
                </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
