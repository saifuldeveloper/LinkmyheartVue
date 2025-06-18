<script setup>

import { Link } from '@inertiajs/vue3';
</script>

<template>
    <aside class="w-100 bg-white min-h-screen border-r shadow-md p-4 pl-8">
        <!-- Profile Info -->
        <div class="text-center mb-8">
            <div
                class="w-20 h-20 rounded-full bg-red-100 mx-auto flex items-center justify-center text-red-700 text-3xl">
                <i class="fas fa-user"></i>
            </div>
            <h2 class="text-lg font-semibold mt-2 text-gray-800">Profile Info</h2>
            <!-- <button
                    class="mt-4 rounded text-white py-[10px] px-4 flex items-center justify-center gap-2 border border-[#ddd] bg-gradient-to-r from-[#f50536bf] to-[#260000b8]">
                   Create B
                </button> -->
        </div>

        <!-- Navigation Links -->
        <nav class="space-y-2 text-gray-700">
            <a href="#" class="flex items-center gap-3 p-2">
                <span class="text-xl">⌘</span>
                <span>Dashboard</span>
            </a>
            <a href="#" class="flex items-center gap-2 p-2 rounded">
                <i class="far fa-edit w-5"></i> <span>Mathes</span>
            </a>
            <a href="#" class="flex items-center gap-2 p-2 rounded">
                <i class="far fa-heart w-5"></i> <span>Messages</span>
            </a>
            <a href="#" class="flex items-center gap-2 p-2 rounded">
                <i class="fas fa-envelope-open-text w-5"></i> <span>Notification</span>
            </a>
            <a href="#" class="flex items-center gap-2 p-2 rounded">
                <i class="fas fa-cog w-5"></i> <span>Profile</span>
            </a>
            <a href="#" class="flex items-center gap-2 p-2 rounded">
                <i class="fas fa-file-download w-5"></i> <span>Verification</span>
            </a>
            <a href="#" class="flex items-center gap-2 p-2 rounded">
                <i class="fas fa-file-download w-5"></i> <span>Contact Information</span>
            </a>
            <a href="#" class="flex items-center gap-2 p-2 rounded">
                <i class="fas fa-file-download w-5"></i> <span>Partner Preference</span>
            </a>
            <Link method="POST" :href="route('logout')"
                class="flex items-center gap-2 p-2 rounded text-red-500 font-semibold">
            <i class="fas fa-sign-out-alt w-5"></i> <span>Logout</span>
            </Link>
        </nav>
    </aside>
</template>