<script setup>

import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const isRouteActive = (name) => {
    return route().current(name)
}

const profile = computed(() => usePage().props.authProfile);


const profileImageUrl = computed(() => {
    return profile.value?.image
        ? `${window.location.origin}/${profile.value.image}`
        : `${window.location.origin}/images/default-avatar.png`;
});


console.log(profileImageUrl.value);

</script>

<template>
    <aside class="w-100 bg-white min-h-screen border-r shadow-md p-4 pl-8">
        <div class="text-center mb-8">

            <div
                class="w-20 h-20 rounded-full bg-red-100 mx-auto flex items-center justify-center text-red-700 text-3xl">
                <template v-if="profile?.image">
                    <img :src="profileImageUrl" alt="Profile Image" class="w-full h-full rounded-full object-cover" />
                </template>
                <template v-else>
                    <i class="fas fa-user"></i>
                </template>

            </div>
            <h2 class="text-lg font-semibold mt-2 text-gray-800">Profile Info</h2>
        </div>
        <!-- Navigation Links -->
        <nav class="space-y-2 text-gray-700">
            <Link :href="route('user.dashboard')"
                :class="['flex items-center gap-3 p-2 rounded hover:bg-red-200', isRouteActive('user.dashboard') ? 'bg-red-200 font-bold text-red-600' : '']">
            <span class="text-xl">⌘</span><span>Dashboard</span>
            </Link>
            <Link :href="route('user.matches')"
                :class="['flex items-center gap-3 p-2 rounded hover:bg-red-200', isRouteActive('user.matches') ? 'bg-red-200 font-bold text-red-600' : '']">
            <i class="fas fa-link"></i>
            <span>Matches</span>
            </Link>
            <Link :href="route('user.messages')" class="flex items-center gap-2 p-2 rounded hover:bg-red-200">
            <i class="fas fa-comments w-5"></i>

            <span>Messages</span>
            </Link>
            <a href="#" class="flex items-center gap-2 p-2 rounded hover:bg-red-200">
                <i class="fas fa-bell"></i> <span>Notification</span>
            </a>
            <Link :href="route('profile.edit')"
                :class="['flex items-center gap-3 p-2 rounded hover:bg-red-200', isRouteActive('profile.edit') ? 'bg-red-200 font-bold text-red-600' : '']">
            <i class="fas fa-user-tie"></i><span>Profile</span>
            </Link>
            <Link :href="route('verify.account')"
                :class="['flex items-center gap-3 p-2 rounded hover:bg-red-200', isRouteActive('verify.account') ? 'bg-red-200 font-bold text-red-600' : '']">
            <i class="fas fa-check-circle"></i> <span>Verification</span>
            </Link>
            <Link :href="route('user.profile.contact')"
                :class="['flex items-center gap-3 p-2 rounded hover:bg-red-200', isRouteActive('user.profile.contact') ? 'bg-red-200 font-bold text-red-600' : '']">
            <i class="fas fa-address-book"></i><span>Profile Contact</span>
            </Link>
            <Link :href="route('partner.preference')"
                :class="['flex items-center gap-3 p-2 rounded hover:bg-red-200', isRouteActive('partner.preference') ? 'bg-red-200 font-bold text-red-600' : '']">
            <i class="fas fa-heart"></i><span>Partner Preference</span>
            </Link>
            <Link method="POST" :href="route('logout.user')"
                class="flex items-center gap-2 p-2 rounded  font-semibold hover:bg-red-200 hover:text-red-600">
            <i class="fas fa-sign-out-alt w-5"></i> <span>Logout</span>
            </Link>
        </nav>
    </aside>
</template>