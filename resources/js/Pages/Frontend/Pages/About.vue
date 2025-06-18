<script setup>
import Footer from '../Layouts/Footer.vue';
import Navbar from '../Layouts/Navbar.vue';
</script>

<template>
  <div class="about-section  bg-[#fac0c0] position-relative">
    <Navbar />
</div>
    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-red-200 to-white text-center py-5">
      <div class="container mx-auto text-center">
        <h1 class="font-bold pt-10 text-5xl">WELCOME TO</h1>
        <p class="mt-4 text-lg">We are dedicated to helping you find your perfect match.</p>
      </div>
    </section>
  <section >
  <div class="min-h-screen bg-gradient-to-b  to-white py-16 px-4">
  <div class="max-w-6xl mx-auto text-center">
    <h2 class="text-3xl font-bold text-pink-600 mb-6">WEDDING MATRIMONY</h2>

    <p class="text-gray-700 max-w-4xl mx-auto mb-8">
      At Link My Heart, we believe that every heart deserves a perfect match. As a dedicated matrimonial platform, we are committed to helping individuals find meaningful connections that lead to lifelong relationships. Our mission is to bring together like-minded souls based on shared values, interests, and aspirations, offering a safe and trusted space for those seeking companionship. Founded on the principles of honesty, integrity, and respect, Link My Heart provides an easy-to-use interface for users to connect with potential life partners. We understand that marriage is one of the most important decisions in life, which is why we go the extra mile to ensure that your search for love is secure, reliable, and guided by your personal preferences.
    </p>

    <p class="text-pink-600 font-medium">
      <a href="#" class="hover:underline">Click here</a> to Start your matrimony service now.
    </p>
  </div>

  <div class="max-w-6xl mx-auto mt-16 grid md:grid-cols-2 gap-12 items-center px-4">
    <!-- Image Section -->
    <div>
      <img src="your-image.jpg" alt="Wedding Couple Holding Hands" class="rounded-[3rem] shadow-lg border-4 border-white">
    </div>

    <!-- Text Section -->
    <div class="text-gray-700">
      <p class="mb-6">
        A trusted matrimonial platform dedicated to helping individuals find true love and meaningful relationships. We understand that marriage is not just about finding a partner, but about discovering someone who shares your values, dreams, and goals. That's why we've created a platform where love and commitment are built on strong foundations. Our journey began with a simple mission: to connect hearts and create lasting bonds. At Link My Heart, we believe that every person deserves the chance to find their ideal partner. Our platform is designed with care to bring together individuals who are serious about finding a life companion, offering advanced matchmaking tools that prioritize compatibility.
      </p>

      <p class="text-pink-600 font-medium mb-6">
        <a href="#" class="hover:underline">Click here</a> to Start your matrimony service now.
      </p>

      <a href="#" class="inline-block bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-6 rounded shadow">
        Get Support
      </a>
    </div>
  </div>
</div>
</section>
    <!-- Footer -->
    <Footer />
  
</template>

