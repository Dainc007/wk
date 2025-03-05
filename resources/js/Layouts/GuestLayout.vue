<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';

</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900"
    >
        <div class="flex space-x-4">
            <NavLink
                :class="['bg-white', 'text-blue-600', 'font-semibold', 'py-2', 'px-4', 'rounded', 'shadow', 'transition', 'duration-300', 'hover:bg-blue-100', { 'bg-blue-200': route().current('login') }]"
                :href="route('login')"
                :active="route().current('login')"
            >
                Login
            </NavLink>
            <NavLink
                :class="['bg-white', 'text-blue-600', 'font-semibold', 'py-2', 'px-4', 'rounded', 'shadow', 'transition', 'duration-300', 'hover:bg-blue-100', { 'bg-blue-200': route().current('register') }]"
                :href="route('register')"
                :active="route().current('register')"
            >
                Register
            </NavLink>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800"
        >
            <slot />
        </div>
    </div>
</template>
