<script setup>

import { Link } from '@inertiajs/vue3';

const isRouteActive = (name) => {
    return route().current(name)
}

</script>

<template>
    <aside class="w-100 bg-white min-h-screen border-r shadow-md p-4 pl-8">
        <div class="text-center mb-8">
            <div
                class="w-20 h-20 rounded-full bg-red-100 mx-auto flex items-center justify-center text-red-700 text-3xl">
                <i class="fas fa-user"></i>
            </div>
            <h2 class="text-lg font-semibold mt-2 text-gray-800">Profile Info</h2>
        </div>

        <!-- Navigation Links -->
        <nav class="space-y-2 text-gray-700">
            <Link :href="route('dashboard')" :class="['flex items-center gap-3 p-2 rounded hover:bg-red-200',isRouteActive('dashboard') ? 'bg-red-200 font-bold text-red-600' : '']">
               <span class="text-xl">⌘</span><span>Dashboard</span>
            </Link>
            <Link :href="route('user.matches')" :class="['flex items-center gap-3 p-2 rounded hover:bg-red-200',isRouteActive('user.matches') ? 'bg-red-200 font-bold text-red-600' : '']">
                 <i class="far fa-edit w-5"></i><span>Matches</span>
            </Link>
            <a href="#" class="flex items-center gap-2 p-2 rounded hover:bg-red-200">
                <i class="far fa-heart w-5"></i> <span>Messages</span>
            </a>
            <a href="#" class="flex items-center gap-2 p-2 rounded hover:bg-red-200">
                <i class="fas fa-envelope-open-text w-5"></i> <span>Notification</span>
            </a>
            <Link :href="route('profile.edit')" :class="['flex items-center gap-3 p-2 rounded hover:bg-red-200',isRouteActive('profile.edit') ? 'bg-red-200 font-bold text-red-600' : '']">
                <i class="fas fa-cog w-5"></i><span>Profile</span>
            </Link>
            <Link href="#" class="flex items-center gap-2 p-2 rounded hover:bg-red-200">
            <i class="fas fa-file-download w-5"></i> <span>Verification</span>
            </Link>
            <Link :href="route('partner.preference')" :class="['flex items-center gap-3 p-2 rounded hover:bg-red-200',isRouteActive('partner.preference') ? 'bg-red-200 font-bold text-red-600' : '']">
                <i class="fas fa-cog w-5"></i><span>Partner Preference</span>
            </Link>
            <Link method="POST" :href="route('logout')"
                class="flex items-center gap-2 p-2 rounded  font-semibold hover:bg-red-200 hover:text-red-600">
            <i class="fas fa-sign-out-alt w-5"></i> <span>Logout</span>
            </Link>
        </nav>
    </aside>
</template>