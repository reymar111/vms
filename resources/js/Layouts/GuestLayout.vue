<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0"
    >
        <div>
            <Link href="/">
                <img
                    src="/logo.png"
                    alt="Logo"
                    class="h-20 w-21 fill-current text-gray-500">

                <!-- <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" /> -->
            </Link>
        </div>
        <div>
            <p class="text-2xl text-gray-900 dark:text-white mt-3">Violation Record Management System</p>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
