<script setup>
import Footer from '../Layouts/Footer.vue';
import Navbar from '../Layouts/Navbar.vue';
</script>

<template>
  <div class="about-section  bg-[#fac0c0] position-relative">
    <!-- Navbar -->
    <Navbar />
    <hr class="top-Header-bottom-border" />
</div>

<div class="min-h-[86vh]">
  
  <section class="bg-gradient-to-b from-red-200 to-white text-center py-7">
    <h1 class="text-4xl pt-5 font-bold text-red-600">FAQs  <br>
    Ask us anything
     
    </h1>
    <p class="text-red-600 mt-2">Have any questions? We're here to assist you.</p>
  </section>

   <!-- FAQ Section -->
  <section class="max-w-6xl mx-auto px-4 py-16">
    <div class="grid md:grid-cols-3 gap-8">
      
      <!-- Card 1 -->
      <div class="flex items-start space-x-4">
        <div class="bg-red-500 text-white p-3 rounded-full">
          <i class="fas fa-envelope text-xl"></i>
        </div>
        <div>
          <h3 class="font-bold text-lg mb-1">How do I change my account email?</h3>
          <p class="text-sm text-gray-700">
            You can log in to your account and change it from your Profile> Edit Profile. Then go to the general tab to change your email.
          </p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="flex items-start space-x-4">
        <div class="bg-red-500 text-white p-3 rounded-full">
          <i class="fas fa-credit-card text-xl"></i>
        </div>
        <div>
          <h3 class="font-bold text-lg mb-1">What should I do if my payment fails?</h3>
          <p class="text-sm text-gray-700">
            If your payment fails, you can use the (COD) payment option, if available. If payment is debited, it will be refunded within 7–10 days.
          </p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="flex items-start space-x-4">
        <div class="bg-red-500 text-white p-3 rounded-full">
          <i class="fas fa-times-circle text-xl"></i>
        </div>
        <div>
          <h3 class="font-bold text-lg mb-1">What is your cancellation policy?</h3>
          <p class="text-sm text-gray-700">
            You can cancel an order if it is in packed/shipped status. Refunds will go back to the original payment method.
          </p>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="flex items-start space-x-4">
        <div class="bg-red-500 text-white p-3 rounded-full">
          <i class="fas fa-box text-xl"></i>
        </div>
        <div>
          <h3 class="font-bold text-lg mb-1">How do I check order delivery status?</h3>
          <p class="text-sm text-gray-700">
            Tap on “My Orders” in the App/Website/M-site main menu to check your order status.
          </p>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="flex items-start space-x-4">
        <div class="bg-red-500 text-white p-3 rounded-full">
          <i class="fas fa-undo-alt text-xl"></i>
        </div>
        <div>
          <h3 class="font-bold text-lg mb-1">What is Instant Refunds?</h3>
          <p class="text-sm text-gray-700">
            Upon successful pickup, refunds will be initiated to your original method. Not available in all areas or for all returns.
          </p>
        </div>
      </div>

      <!-- Card 6 -->
      <div class="flex items-start space-x-4">
        <div class="bg-red-500 text-white p-3 rounded-full">
          <i class="fas fa-tags text-xl"></i>
        </div>
        <div>
          <h3 class="font-bold text-lg mb-1">How do I apply a coupon on my order?</h3>
          <p class="text-sm text-gray-700">
            Apply coupons before checkout. View valid coupons under the “My Coupons” tab in the App/Website/M-site.
          </p>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer Help Box -->
  <section class="pb-5 mx-auto">
    <div class="container mx-auto px-20 grid md:grid-1 gap-8 ">
    <div class="bg-red-200 px-20 p-6 rounded-lg flex flex-col md:flex-row items-center justify-between ">
      <div class="text-center md:text-left">
        <h4 class="font-semibold text-red-800">Still have questions?</h4>
        <p class="text-sm text-red-700">Can’t find the answer you’re looking for? Please chat to our friendly team.</p>
      </div>
      <a href="#" class="mt-4 md:mt-0 bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md font-semibold">
        Get in touch
      </a>
    </div>
    </div>
  </section>

  </div>
    <!-- Footer -->
    <Footer />
  
</template>

<style scoped>
.position-relative {
  position: relative;
}

.top-Header-bottom-border {
  margin: 0;
  height: 3px;
  background: linear-gradient(
    90deg,
    rgba(252, 202, 213, 0) 0%,
    rgba(244, 54, 98, 1) 50%,
    rgba(255, 255, 255, 0) 100%
  );
  width: 100%;
  border: none;
}
</style>
