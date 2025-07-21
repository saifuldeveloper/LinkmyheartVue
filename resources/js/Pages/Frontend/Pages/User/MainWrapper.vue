<script setup>
import Navbar from '../../Layouts/Navbar.vue';
import Sidebar from './Sidebar.vue';
import Footer from '../../Layouts/Footer.vue';
</script>
<template>
  <div>
    <div class="about-section bg-[#fac0c0] position-relative">
      <Navbar />
    </div>
    <div class="flex min-h-screen">
      <Sidebar />
      <main class="flex-1 bg-gray-50">
        <slot />
      </main>
    </div>
  </div>
  <Footer />
</template>
