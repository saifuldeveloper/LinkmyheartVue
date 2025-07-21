<script setup>
import { ref } from 'vue';
import Footer from '../Layouts/Footer.vue';
import Navbar from '../Layouts/Navbar.vue';
import { Link, usePage } from '@inertiajs/vue3';




</script>

<template>
    <div class="home-section bg-gray-100 min-h-screen">
        <Navbar />
        <section class="hero-section  items-center min-h-[40vh] md:min-h-[50vh] lg:min-h-[60vh]">
            <div class="container mx-auto text-center lg-pt-31">
                <h1 class="font-bold text-5xl">FIND YOUR RIGHT</h1>
                <h1 class="font-bold text-5xl mt-3 text-red-600">Match Here</h1>
                <a href="#"
                    class="inline-block mt-8 px-10 py-3 text-white font-medium rounded py-[10px] px-4  items-center justify-center gap-2 border border-[#dddd] bg-gradient-to-r from-[#f50536bf] to-[#260000b8] rounded-lg">
                    Join Now
                </a>
            </div>
        </section>
        <!-- Filter Form -->
        <section class="">
            <div class="container mx-auto mt-12">
                <div class="search-box">
                    <form>
                        <div class="flex flex-wrap md:flex-nowrap gap-4 justify-center">
                            <!-- I'm Looking For -->
                            <div class="w-full md:w-1/4">
                                <label class="block mb-1 font-semibold">I'm Looking For</label>
                                <select
                                    class="w-full border rounded px-3 py-2  focus:outline-none focus:border-red-300 focus:ring-2 focus:ring-red-200">
                                    <option selected>All</option>
                                    <option>Bride</option>
                                    <option>Groom</option>
                                </select>
                            </div>

                            <!-- Marital Status -->
                            <div class="w-full md:w-1/4">
                                <label class="block mb-1 font-semibold">Marital Status</label>
                                <select
                                    class="w-full border rounded px-3 py-2  focus:outline-none focus:border-red-300 focus:ring-2 focus:ring-red-200">
                                    <option selected>Marital Status</option>
                                    <option>Single</option>
                                    <option>Divorced</option>
                                    <option>Widowed</option>
                                </select>
                            </div>

                            <!-- Any Divisions -->
                            <div class="w-full md:w-1/4">
                                <label class="block mb-1 font-semibold">Any Divisions</label>
                                <select
                                    class="w-full border rounded px-3 py-2  focus:outline-none focus:border-red-300 focus:ring-2 focus:ring-red-200">
                                    <option selected>Any Divisions</option>
                                    <option>Dhaka</option>
                                    <option>Barisal</option>
                                    <option>Khulna</option>
                                </select>
                            </div>

                            <!-- Search Button -->
                            <div class="w-full md:w-1/4 self-end">
                                <!-- <button type="submit"
                                    class="w-full text-white font-medium rounded py-[10px] px-4 flex items-center justify-center gap-2 border border-[#dddd] bg-gradient-to-r from-[#f50536bf] to-[#260000b8]">
                                    <i class="bi bi-search"></i> Search
                                </button> -->
                                <Link :href="route('filtering')"
                                    class="w-full text-white font-medium rounded py-[10px] px-4 flex items-center justify-center gap-2 border border-[#ddd] bg-gradient-to-r from-[#f50536bf] to-[#260000b8]">
                                <i class="bi bi-search"></i> Search
                                </Link>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>

    </div>
    <!-- Stats Section -->
    <section
        class="stats-section  text-center py-[60px] min-h-[20vh] md:min-h-[40vh] lg:min-h-[40vh] bg-[linear-gradient(180deg,_rgba(252,202,213,1)_16%,_rgba(255,255,255,1)_50%)]">
        <div class="container mx-auto">
            <h4 class="font-bold text-3xl mb-12">Let’s not Wait To Meet</h4>
            <div class="flex justify-center gap-16 flex-wrap">
                <div class="text-center md:w-1/4">
                    <i class="bi bi-google-play text-6xl text-red-600"></i>
                    <h3 class="mt-4 text-xl font-semibold">Download App</h3>
                </div>
                <div class="text-center md:w-1/4">
                    <i class="bi bi-youtube text-6xl text-red-600"></i>
                    <h3 class="mt-4 text-xl font-semibold">Watch Our Video</h3>
                </div>
            </div>
        </div>
    </section>
    <Footer />

</template>

<style scoped>
.home-section {
    background-image: url("/frontend/images/Linkmyhaert-web-banner.png");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
}

.hero-section {
    padding: 60px 0;
    font-family: "Poppins";
    display: flex;
    align-items: center;
    flex-direction: column;
    text-align: center;
}

.search-box {
    background: #ffffffcf;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    position: relative;
    z-index: 1;
    margin-top: -40px;
}


@media only screen and (min-width: 1400px) {
    .hero-section {
        padding: 150px 0;
    }
}
</style>
