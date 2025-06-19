<script setup>
import MainWrapper from './MainWrapper.vue';
</script>
<template>
    <MainWrapper>
        <div class="py-5 px-5">
            <!-- <div class="text-center mb-6">
                <button
                    class=" text-white px-6 py-2 rounded-full text-lg font-bold   gap-2 border border-[#ddd] bg-gradient-to-r from-[#f50536bf] to-[#260000b8] ">
                    Your Information
                </button>
            </div> -->
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class=" text-dark rounded-lg p-6 text-center shadow-md bg-[#fac0c0] position-relative">
                    <div class="text-2xl font-bold">0</div>
                    <div class="mt-1 text-sm">Connection Request</div>
                    <button
                        class="mt-3  text-white border-[#ddd] bg-gradient-to-r from-[#f50536bf] to-[#260000b8] px-4 py-2 rounded-full">Buying
                        Plan</button>
                </div>
                <div class="bg-white rounded-lg p-6 text-center shadow-md">
                    <div class="text-2xl font-bold text-red-600">0</div>
                    <div class="mt-1 text-sm font-medium">Profile visit Count</div>
                    <!-- <div class="mt-4 flex justify-center gap-4 text-sm text-gray-600">
                        <span>শেষ ৩০ দিন: 0</span>
                        <span>শেষ ৭ দিন: 0</span>
                        <span>আজকে: 0</span>
                    </div> -->
                </div>
                <div class="bg-white rounded-lg p-6 text-center shadow-md">
                    <div class="text-2xl font-bold text-red-600">0</div>
                    <div class="mt-1 text-sm">fffffffff</div>
                    <p class="text-xs mt-2"></p>
                </div>
            </div>

            <!-- More Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-white rounded-lg p-6 text-center shadow-md">
                    <div class="text-2xl font-bold text-red-800">0</div>
                    <div class="mt-1 text-sm">Send Request</div>
                </div>
                <div class="bg-white rounded-lg p-6 text-center shadow-md">
                    <div class="text-2xl font-bold text-red-800">0</div>
                    <div class="mt-1 text-sm">connected </div>
                </div>
                <div class="bg-white rounded-lg p-6 text-center shadow-md">
                    <div class="text-2xl font-bold text-red-800">0</div>
                    <div class="mt-1 text-sm">Pending Request</div>
                </div>
            </div>

        </div>

    </MainWrapper>
</template>