<script setup>
import MainWrapper from './MainWrapper.vue';
</script>
<template>
    <MainWrapper>
        <!-- Profile Header -->
        <div class="bg-rose-500 text-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="relative w-24 h-24 border-4 border-white rounded-full overflow-hidden">
                    <img src="/default-avatar.png" alt="Profile" class="object-cover w-full h-full" />
                    <button class="absolute bottom-0 right-0 bg-white text-rose-500 p-1 rounded-full text-xs">
                        ⬆
                    </button>
                </div>
                <div class="ml-6">
                    <h2 class="text-2xl font-bold">saiful <span class="text-sm underline cursor-pointer">Change</span>
                    </h2>
                    <p class="mt-1">- hi</p>
                    <div class="mt-2 text-sm">
                        <p>Birthday: <span class="font-semibold">1999-07-11</span></p>
                        <p>City: <span class="font-semibold">Dhaka</span></p>
                        <p>Religion: <span class="font-semibold">Islam</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Completion -->
        <div class="bg-gray-200 mt-6 p-4 rounded">
            <h3 class="text-rose-500 font-semibold">Profile Completion</h3>
            <div class="w-full bg-white rounded-full h-3 mt-2">
                <div class="bg-rose-500 h-3 rounded-full" style="width: 23%"></div>
            </div>
            <p class="text-xs mt-1 text-right text-gray-600">23%</p>
        </div>

        <!-- My Photos -->
        <div class="bg-gray-200 mt-4 p-4 rounded flex justify-between items-center">
            <h3 class="text-gray-800 font-semibold">My photos</h3>
            <div class="flex gap-4 text-sm text-rose-500">
                <span class="cursor-pointer">Change</span>
                <span class="cursor-pointer">Show 👁‍🗨</span>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="bg-gray-200 mt-4 p-4 rounded">
            <div class="flex justify-between items-center text-sm text-rose-500">
                <div class="font-semibold">Contact Information</div>
                <div class="flex gap-4">
                    <span class="cursor-pointer">Change ✏️</span>
                    <span class="cursor-pointer">Hide 👁️</span>
                </div>
            </div>
            <div class="mt-2 flex gap-4 text-sm">
                <span class="bg-white px-2 py-1 rounded">Email:</span>
                <span class="bg-white px-2 py-1 rounded">Phone: +880 01518987898</span>
            </div>
        </div>

        <!-- About -->
        <div class="bg-gray-200 mt-4 p-4 rounded">
            <div class="flex justify-between text-sm text-rose-500">
                <span class="font-semibold">Freely about yourself</span>
                <span class="cursor-pointer">Change ✏️</span>
            </div>
            <p class="mt-2 text-sm text-gray-700 italic">Write a short description about yourself!</p>
        </div>

      
    </MainWrapper>
</template>