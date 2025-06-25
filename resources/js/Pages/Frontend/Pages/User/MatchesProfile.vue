<script setup>
import MainWrapper from './MainWrapper.vue';

</script>
<template>
    <MainWrapper>

        <div class="min-h-screen bg-gradient-to-b from-pink-100 to-white p-6">
            <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Profile Image -->
                    <div class="md:w-1/3 flex justify-center">
                        <img src="/path/to/image.jpg" alt="Profile" class="w-72 h-96 object-cover rounded-md shadow">
                    </div>
                    <!-- Profile Info -->
                    <div class="md:w-2/3">
                        <div class="flex justify-between items-start">
                            <div class="bg-rose-500">
                                <h2 class="text-2xl font-semibold text-white p-4 rounded-t-lg">Nadira Aktar
                                </h2>
                                <div class="text-white px-4 py-2 rounded-b-lg">
                                    <p>Age: <span class="ml-2">yr</span></p>
                                    <p>Marital Status:</p>
                                    <p>Religion:</p>
                                    <p>Address:</p>
                                </div>
                            </div>
                            <button
                                class="bg-rose-500 text-white px-5 py-2 rounded-lg shadow hover:bg-rose-600 transition">
                                Send Connect Request
                                <div class="text-center text-xs mt-1">👥</div>
                            </button>
                        </div>

                        <!-- Intro Section -->
                        <div class="mt-6">
                            <h3 class="text-xl font-semibold text-rose-600 mb-2">Nadira aktar Intro 📇</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                                <div><span class="font-semibold">Nationality:</span> </div>
                                <div><span class="font-semibold">Birth Place:</span> </div>
                                <div><span class="font-semibold">Height:</span> Inch</div>
                                <div><span class="font-semibold">Weight:</span> kg</div>
                                <div><span class="font-semibold">Body Type:</span> </div>
                                <div><span class="font-semibold">Complexion:</span> </div>
                                <div><span class="font-semibold">Blood Group:</span> </div>
                                <div><span class="font-semibold">Family Status:</span> </div>
                                <div><span class="font-semibold">Living With Family?</span> </div>
                            </div>
                        </div>

                        <!-- Education Section -->
                        <div class="mt-6">
                            <h3 class="text-xl font-semibold text-rose-600 mb-2">Education 🎓</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                                <div><span class="font-semibold">Highest Educational:</span> </div>
                                <div><span class="font-semibold">Education Institute:</span> </div>
                                <div><span class="font-semibold">Passing Year:</span> </div>
                            </div>
                        </div>

                        <!-- Work Section -->
                        <div class="mt-6">
                            <h3 class="text-xl font-semibold text-rose-600 mb-2">Work 💼</h3>
                            <!-- Add work details here -->
                        </div>




                        <div class="max-w-6xl mx-auto p-6 text-pink-700">
                            <!-- Section Title -->
                            <h2 class="text-2xl font-bold flex items-center gap-2 mb-6">What is She Looking For ! 💋
                            </h2>

                            <!-- Profile Match Overview -->
                            <div class="grid grid-cols-3 gap-4 items-center mb-8">
                                <!-- Her Preference -->
                                <div class="flex flex-col items-center">
                                    <img src="https://via.placeholder.com/100" alt="Her Preference"
                                        class="rounded-full w-24 h-24 border border-pink-400 object-cover" />
                                    <span class="text-sm mt-2">Her Preference</span>
                                </div>

                                <!-- Match Count -->
                                <div class="text-center">
                                    <hr class="mb-2 border-dashed border-gray-400" />
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm">Total Matches: 2
                                        out of 6</span>
                                </div>

                                <!-- Your Match -->
                                <div class="flex flex-col items-center">
                                    <div class="rounded-full w-24 h-24 border border-pink-400"></div>
                                    <span class="text-sm mt-2">Your Match</span>
                                </div>
                            </div>

                            <!-- Preferences Comparison -->
                            <div class="grid grid-cols-2 gap-6 text-sm">
                                <!-- Preferences Left -->
                                <div class="space-y-4">
                                    <div class="border-b border-pink-300 pb-1">
                                        <span class="text-pink-600 font-semibold">Religion :</span><br />
                                        Islam
                                    </div>
                                    <div class="border-b border-pink-300 pb-1">
                                        <span class="text-pink-600 font-semibold">Marital Status :</span><br />
                                        Single
                                    </div>
                                    <div class="border-b border-pink-300 pb-1">
                                        <span class="text-pink-600 font-semibold">Age :</span><br />
                                        21yr to 23yr
                                    </div>
                                    <div class="border-b border-pink-300 pb-1">
                                        <span class="text-pink-600 font-semibold">Education :</span><br />
                                        Higher Secondary
                                    </div>
                                    <div class="border-b border-pink-300 pb-1">
                                        <span class="text-pink-600 font-semibold">Location :</span><br />
                                        Dhaka
                                    </div>
                                    <div class="border-b border-pink-300 pb-1">
                                        <span class="text-pink-600 font-semibold">Height :</span><br />
                                        5'8"Inch to 5'9"Inch
                                    </div>
                                </div>

                                <!-- Match Result Right -->
                                <div class="space-y-4 text-right pr-4">
                                    <div class="border-b border-pink-300 pb-1 text-green-600">✔️</div>
                                    <div class="border-b border-pink-300 pb-1 text-red-600">❌</div>
                                    <div class="border-b border-pink-300 pb-1 text-red-600">❌</div>
                                    <div class="border-b border-pink-300 pb-1 text-red-600">❌</div>
                                    <div class="border-b border-pink-300 pb-1 text-green-600">✔️</div>
                                    <div class="border-b border-pink-300 pb-1 text-red-600">❌</div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>



        </div>

    </MainWrapper>
</template>