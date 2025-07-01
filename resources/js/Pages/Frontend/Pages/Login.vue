<script setup>
import Footer from '../Layouts/Footer.vue';
import Navbar from '../Layouts/Navbar.vue';
import { useForm, router } from '@inertiajs/vue3'

const form = useForm({
  phone: '',
  password: '',
})


function submit() {
  form.post('/login-user')
}

</script>

<template>
  <div class="min-h-[95vh] flex flex-col">
    <!-- Header Section with Navbar -->
    <div class="about-section bg-[#fac0c0] relative">
      <Navbar />
    </div>
    <!-- Login Form Section -->
    <section
      class="flex-grow flex items-start md:items-center justify-center mt-5 md:mt-0 px-4 bg-gradient-to-b from-red-100">
      <div class="w-full md:w-1/3 border border-red-100 shadow-red rounded-lg p-6 bg-white shadow-md text-center">
        <form class=" space-y-5" @submit.prevent="submit">
          <h1 class="text-4xl pt-10 font-bold text-red-600 py-10">Login</h1>
          <!-- Phone Input -->
          <input type="text" placeholder="Phone" v-model="form.phone"
            class="w-full px-4 py-3 border border-red-400 rounded-md focus:outline-none focus:ring-2 focus:ring-red-300" />
             <p v-if="form.errors.phone" class="text-red-500 text-sm">{{ form.errors.phone }}</p>
          <!-- Password Input -->
          <input type="password" placeholder="Password" v-model="form.password"
            class="w-full px-4 py-3 border border-red-400 rounded-md focus:outline-none focus:ring-2 focus:ring-red-300" />
              <p v-if="form.errors.password" class="text-red-500 text-sm">{{ form.errors.password }}</p>
          <!-- Submit Button -->

          <button type="submit" :disabled="form.processing"
            class="w-full bg-gradient-to-r from-[#f50536bf] to-[#260000b8] text-white font-semibold py-3 rounded-md transition-all duration-200 flex items-center justify-center">
            <i class="fas fa-sign-in-alt mr-2"></i> Login
          </button>

          <!-- Bottom Links -->
          <div class="flex justify-between text-sm text-gray-600">
            <a href="#" class="hover:underline">Create Account</a>
            <a href="#" class="hover:underline">Forget Password?</a>
          </div>
        </form>
      </div>
    </section>
  </div>
  <!-- Footer -->
  <Footer />

  </template>


