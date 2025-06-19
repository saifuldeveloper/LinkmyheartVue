<script setup>
import MainWrapper from './MainWrapper.vue';
import { ref } from 'vue'


</script>
<template>
    <MainWrapper>
        <section class="mx-auto  md:w-1/1">
            <div class=" mt-5 p-8 max-w-6xl mx-auto rounded-md  border border-red-300 font-sans">
                <div class=" bg-red-400 text-white rounded-lg p-6 flex gap-6 items-start">
                    <!-- Profile Image -->
                    <div class="relative">
                        <div class="w-32 h-32 rounded-lg bg-white flex items-center justify-center">
                            <svg class="w-20 h-20 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v2h20v-2c0-3.3-6.7-5-10-5z" />
                            </svg>
                        </div>
                        <!-- Upload Icon -->
                        <button
                            class="absolute bottom-1 right-1 bg-white text-red-400 rounded-full p-1 shadow hover:scale-105 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M5 20h14v-2H5v2zm7-9l5 5h-3v4h-4v-4H7l5-5zM12 2L6.5 7.5h3V14h3V7.5h3L12 2z" />
                            </svg>
                        </button>
                    </div>

                    <!-- User Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <h2 class="text-xl font-bold">saiful</h2>
                            <span class="">Change</span>
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828zM5 14h10v2H5v-2z" />
                            </svg>
                        </div>

                        <p class="mt-1">- hi</p>

                        <hr class="my-3 border-red-400">

                        <!-- Details Grid -->
                        <div class="grid grid-cols-2 gap-4 ">
                            <div class="flex gap-2">
                                <span class="font-semibold">Birthday :</span>
                                <span>1999-07-11</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="font-semibold">City :</span>
                                <span>Dhaka</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="font-semibold">Religion :</span>
                                <span>Islam</span>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="bg-gray-200 rounded-lg p-4 gap-5 my-5">
                    <div class="flex justify-between items-center text-red-600 font-semibold">
                        <div>My photos</div>
                        <div class="flex items-center gap-3">
                            <button class="flex items-center gap-1 hover:underline">
                                Change <i class="fas fa-pen text-xs"></i>
                            </button>
                            <button class="flex items-center gap-1 hover:underline">
                                Show <i class="fas fa-eye-slash text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Contact Information Section -->
                <div class="bg-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-center text-red-600 font-semibold">
                        <div>Contact Information</div>
                        <div class="flex items-center gap-3">
                            <button class="flex items-center gap-1 hover:underline">
                                Change <i class="fas fa-pen text-xs"></i>
                            </button>
                            <button class="flex items-center gap-1 hover:underline">
                                Hide <i class="fas fa-eye text-xs"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3 flex gap-4 flex-wrap">
                        <span class="bg-white px-3 py-1 rounded-full shadow text-gray-800">Email:</span>
                        <span class="bg-white px-3 py-1 rounded-full shadow text-gray-800">Phone: +880
                            01518987898</span>
                    </div>
                </div>


                <!-- Freely About Yourself Section -->
                <div class="bg-gray-200 rounded-lg p-4 my-5">
                    <div class="flex justify-between items-center text-red-600 font-semibold">
                        <div>Freely about yourself</div>
                        <button class="flex items-center gap-1 hover:underline">
                            Change <i class="fas fa-pen text-xs"></i>
                        </button>
                    </div>
                    <p class="mt-3 text-gray-700">Write a short description about yourself!</p>
                </div>


                <!-- ddd -->
                <div class="bg-gray-200 p-6 rounded-lg max-w-6xl mx-auto  space-y-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center text-red-600 font-semibold">
                        <span>Personal information</span>
                        <button class="flex items-center gap-1 hover:underline">
                            Change <i class="fas fa-pen text-xs"></i>
                        </button>
                    </div>

                    <!-- Appearance -->
                    <div>
                        <h2 class="font-bold mb-2">Appearance</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label>Height</label>
                                <p class="text-gray-600">Please Select</p>
                            </div>
                            <div>
                                <label>Weight</label>
                                <p class="text-gray-600">Please Select</p>
                            </div>
                            <div>
                                <label>Blood Group</label>
                                <p class="text-gray-600">Please Select</p>
                            </div>
                            <div>
                                <label class="underline text-red-600">Body Type</label>
                                <p class="text-gray-600">Please Select</p>
                            </div>
                            <div>
                                <label class="underline text-red-600">Complexion</label>
                                <p class="text-gray-600">Please Select</p>
                            </div>
                        </div>
                        <hr class="border-red-500 mt-4">
                    </div>

                    <!-- Education -->
                    <div>
                        <h2 class="font-bold mb-2">Education</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label>Educational Level</label>
                                <p class="text-gray-600">Select Education Level</p>
                            </div>
                            <div>
                                <label>Education Institute</label>
                                <input type="text" class="w-full p-2 rounded border" />
                            </div>
                            <div>
                                <label>Year</label>
                                <input type="text" class="w-full p-2 rounded border" />
                            </div>
                        </div>
                        <hr class="border-red-500 mt-4">
                    </div>

                    <!-- Work -->
                    <div>
                        <h2 class="font-bold mb-2">Work</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label>Profession</label>
                                <p class="text-gray-600">Please Select</p>
                            </div>
                            <div>
                                <label>Position</label>
                                <input type="text" class="w-full p-2 rounded border" />
                            </div>
                            <div>
                                <label>Your Income (Monthly)</label>
                                <p class="text-gray-600">Please Select</p>
                            </div>
                        </div>
                        <hr class="border-red-500 mt-4">
                    </div>

                    <!-- General -->
                    <div>
                        <h2 class="font-bold mb-2">General</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label>Account For</label>
                                <p class="text-gray-600">Self</p>
                            </div>
                            <div>
                                <label>Gender</label>
                                <p class="text-gray-600">Female</p>
                            </div>
                            <div>
                                <label>Marital Status</label>
                                <p class="text-gray-600">Single</p>
                            </div>
                            <div>
                                <label>Nationality</label>
                                <p class="text-gray-600">Bangladesh</p>
                            </div>
                            <div>
                                <label>Birth Place</label>
                                <p class="text-gray-600">Comilla</p>
                            </div>
                            <div>
                                <label>Family Status</label>
                                <p class="text-gray-600">Rich</p>
                            </div>
                            <div>
                                <label class="underline text-red-600">Living With Family ?</label>
                                <p class="text-gray-600">Yes</p>
                            </div>
                            <div>
                                <label>Smoking</label>
                                <p class="text-gray-600">Yes</p>
                            </div>
                            <div>
                                <label>Drinking</label>
                                <p class="text-gray-600">Yes</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="bg-gray-200 rounded-md p-4 flex flex-wrap items-center gap-2 my-5">
                    <div class="text-red-600 font-semibold mr-1">I'm looking for</div>
                    <button class="text-red-600 underline flex items-center gap-1">
                        Change
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536M9 13l6.536-6.536a2 2 0 112.828 2.828L11.828 15.828a4 4 0 01-1.414.828l-4.243 1.414 1.414-4.243a4 4 0 01.828-1.414z" />
                        </svg>
                    </button>

                    <!-- Filters -->
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Bride</div>
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Age : yr - 22yr</div>
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Islam</div>
                    <span class="text-gray-600">—</span>
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Dhaka</div>
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Secondary Education</div>
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Height : 4.0' Inch - 4.5' Inch</div>
                </div>



            </div>


            <!-- ============ -->


        </section>

    </MainWrapper>
</template>