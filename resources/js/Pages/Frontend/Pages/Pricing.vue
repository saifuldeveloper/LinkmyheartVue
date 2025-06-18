<script setup>
import Footer from '../Layouts/Footer.vue';
import Navbar from '../Layouts/Navbar.vue';
</script>

<template>
    <div class="min-h-screen">
        <div class="about-section  bg-[#fac0c0] position-relative">
            <Navbar />
        </div>
        <!-- Header Section -->
        <section class="bg-gradient-to-b from-red-100 to-white text-center py-5 pt-10">
            <h1 class="text-4xl pt-5 font-bold text-red-600">Membership Packages</h1>
            <p class="text-gray-600 mt-2">4 Convenient Premium Packages to Choose From!</p>
            <div>
                <div class="max-w-7xl pt-20 mx-auto py-12 px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Standard Plan -->
                    <div class="bg-white rounded-xl shadow-md p-6 text-center">
                        <p class="text-red-600 text-2xl font-bold">
                            ৳ 299 <span class="text-sm font-normal">/ 7 Days</span>
                        </p>
                        <h2 class="text-xl font-bold mt-4 text-red-700">1 Star</h2>
                        <p class="text-gray-600 mb-4">Standard Plan</p>
                        <ul class="text-left text-gray-700 space-y-2 mb-6">
                            <li>✅ Free Registration</li>
                            <li>✅ Limited profile views</li>
                            <li>✅ Send Request</li>
                        </ul>
                        <button class="bg-red-400 hover:bg-red-500 text-white px-6 py-2 rounded-full">
                            Choose Plan
                        </button>
                    </div>

                    <!-- Silver Plan -->
                    <div class="bg-white rounded-xl shadow-md p-6 text-center">
                        <p class="text-red-600 text-2xl font-bold">
                            ৳ 499 <span class="text-sm font-normal">/ 15 Days</span>
                        </p>
                        <h2 class="text-xl font-bold mt-4 text-red-700">3 Star</h2>
                        <p class="text-gray-600 mb-4">Silver Plan</p>
                        <ul class="text-left text-gray-700 space-y-2 mb-6">
                            <li>✅ Free Registration</li>
                            <li>✅ 50 Profile Views</li>
                            <li>✅ Send Request</li>
                            <li>✅ Verified Profile Option</li>
                            <li>✅ Chatting Option</li>
                        </ul>
                        <button class="bg-red-400 hover:bg-red-500 text-white px-6 py-2 rounded-full">
                            Choose Plan
                        </button>
                    </div>

                    <!-- Gold Plan -->
                    <div class="bg-white rounded-xl shadow-md p-6 text-center">
                        <p class="text-red-600 text-2xl font-bold">
                            ৳ 799 <span class="text-sm font-normal">/ 1 Month</span>
                        </p>
                        <h2 class="text-xl font-bold mt-4 text-red-700">4 Star</h2>
                        <p class="text-gray-600 mb-4">Gold Plan</p>
                        <ul class="text-left text-gray-700 space-y-2 mb-6">
                            <li>✅ Free Registration</li>
                            <li>✅ 100 Profile Views</li>
                            <li>✅ Send Request</li>
                            <li>✅ Verified Profile Option</li>
                            <li>✅ Chatting Option</li>
                        </ul>
                        <button class="bg-red-400 hover:bg-red-500 text-white px-6 py-2 rounded-full">
                            Choose Plan
                        </button>
                    </div>

                    <!-- Platinum Plan -->
                    <div class="bg-white rounded-xl shadow-md p-6 text-center">
                        <p class="text-red-600 text-2xl font-bold">
                            ৳ 3999 <span class="text-sm font-normal">/ 3 Month</span>
                        </p>
                        <h2 class="text-xl font-bold mt-4 text-red-700">5 Star</h2>
                        <p class="text-gray-600 mb-4">Platinum Plan</p>
                        <ul class="text-left text-gray-700 space-y-2 mb-6">
                            <li>✅ Free Registration</li>
                            <li>✅ Unlimited Profile Views</li>
                            <li>✅ Send Request</li>
                            <li>✅ Verified Profile Option</li>
                            <li>✅ Unlimited Chatting Option</li>
                            <li>✅ Dedicated Support Executive</li>
                        </ul>
                        <button class="bg-red-400 hover:bg-red-500 text-white px-6 py-2 rounded-full">
                            Choose Plan
                        </button>
                    </div>

                </div>
            </div>
        </section>


    </div>
    <!-- Footer -->
    <Footer />

</template>
