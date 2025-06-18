<script setup>
import Footer from '../Layouts/Footer.vue';
import Navbar from '../Layouts/Navbar.vue';
</script>

<template>
   <div class="min-h-screen">
  <div class="about-section  bg-[#fac0c0] position-relative">
    <!-- Navbar -->
    <Navbar />
    <hr class="top-Header-bottom-border" />
  </div>
   
  <!-- Header Section -->
 
  <section class="bg-gradient-to-b from-red-200 to-white text-center py-5">
    <h1 class="text-4xl pt-5 font-bold text-red-600">Support</h1>
    <p class="text-gray-600 mt-2">Have any questions? We're here to assist you.</p>

    <div class="text-sm text-gray-800 space-y-1">
      <p><span class="font-bold text-red-700">Office Address:</span> H-1111, R-10, AVE-08, Mirpur DOHS, Dhaka-1212</p>
      <p><span class="font-bold text-red-700">Email:</span> <a href="mailto:info@linkmyheart.com" class="text-red-600">info@linkmyheart.com</a></p>
      <p><span class="font-bold text-red-700">Phone:</span> 01901-348198</p>
    </div>
  </section>

  <!-- Form Section -->
  <section class="max-md mx-auto mt-5  md:w-1/2">
    <p class="text-center mb-6 font-medium">
      Welcome to our Support Center! Please fill in the form below before starting the chat
    </p>
    <form class="space-y-5 pt-5">
      <input type="text" placeholder="Name" class="w-full px-4 py-3 border border-red-400 rounded-md focus:outline-none focus:ring-2 focus:ring-red-300" />
      <input type="email" placeholder="Email" class="w-full px-4 py-3 border border-red-400 rounded-md focus:outline-none focus:ring-2 focus:ring-red-300" />
      <input type="tel" placeholder="Phone Number" class="w-full px-4 py-3 border border-red-400 rounded-md focus:outline-none focus:ring-2 focus:ring-red-300" />
      <textarea placeholder="Type your message..." rows="4" class="w-full px-4 py-3 border border-red-400 rounded-md focus:outline-none focus:ring-2 focus:ring-red-300"></textarea>
      <button type="submit" class="w-full border-[#dddd] bg-gradient-to-r from-[#f50536bf] to-[#260000b8] text-white font-semibold py-3 rounded-md transition-all duration-200">
        Send <i class="fas fa-paper-plane ml-2"></i>
      </button>
    </form>
  </section>
 
 </div>
    <!-- Footer -->
    <Footer />
  
</template>
