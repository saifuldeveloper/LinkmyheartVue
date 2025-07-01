<script setup>
import MainWrapper from './MainWrapper.vue';
import { ref, reactive, computed } from 'vue';
import { router,usePage } from '@inertiajs/vue3'

const page = usePage()
const profiles = computed(() => page.props.profiles);



// const allBiodata = ref([
//   {
//     id: 'ODM-1477',
//     name: 'Sabina',
//     age: 26,
//     height: '5\' 4\'\'',
//     description: 'Dhaka - Mirpur',
//     image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P1', 
//   },
//   {
//     id: 'ODF-16889',
//     name:  'Joyi',
//     age: 22,
//     height: '5\' 1\'\'',
//     description: 'Purb - Faridpur',
//     image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P2',
//   },
//   {
//     id: 'ODF-20999',
//     name: 'Tania',
//     age: 25,
//     height: '5\' 0\'\'',
//     description: 'Purb - Chittagong',
//     image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P3',
//   },
//   {
//     id: 'ODM-1127',
//     name: 'Hasan',
//     age: 28,
//     height: '5\' 4\'\'',
//     description: 'Dhaka - Mirpur',
//     image: '', // Example with no image
//   },
//   {
//     id: 'ODF-10359',
//     name: 'Shina',
//     age: 24,
//     height: '5\' 2\'\'',
//     description: 'Purb - Faridpur',
//     image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P5',
//   },
//   {
//     id: 'ODM-14221',
//     name: 'Rahim',
//     age: 26,
//     height: '5\' 0\'\'',
//     description: 'Dhaka - Mirpur',
//     image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P6',
//   },
//   {
//     id: 'ODF-21633',
//     name: 'Sathi',
//     age: 21,
//     height: '5\' 6\'\'',
//     description: 'Purb - Chittagong',
//     image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P7',
//   },
//   {
//     id: 'ODF-21656',
//     name: 'Nasreen',
//     age: 21,
//     height: '5\' 1\'\'',
//     description: 'Purb - Chittagong',
//     image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P8',
//   },
//   {
//     id: 'ODF-16442',
//     name: 'Purb - Ulla',
//     age: 20,
//     height: '5\' 5\'\'',
//     description: 'Purb - Chittagong',
//     image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P9',
//   },
//   {
//     id: 'ODM-1001',
//     name: 'মোঃ রনি',
//     age: 30,
//     height: '5\' 6\'\'',
//     description: 'barishal - sadar',
//     image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P10',
//   },
//   {
//     id: 'ODF-22001',
//     name: 'Sumona',
//     age: 23,
//     height: '5\' 3\'\'',
//     description: 'Dhaka - Banani',
//     image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P11',
//   },
//   {
//     id: 'ODM-15002',
//     name: 'Sabbir',
//     age: 27,
//     height: '5\' 7\'\'',
//     description: 'Dhaka - Uttara',
//     image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P12',
//   },
// ]);

// Pagination Logic
const itemsPerPage = 30; // Display 9 items per page (3 rows of 3 cards)
const currentPage = ref(1); // Current active page

// Computed property to calculate total number of pages
const totalPages = computed(() => {
  return Math.ceil(profiles.value.length / itemsPerPage);
});

// Computed property to get biodata for the current page
const paginatedBiodata = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return profiles.value.slice(start, end);
});

// Function to navigate to a specific page
const goToPage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
  }
};

// Function to go to the next page
const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};

// Function to go to the previous page
const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};
</script>
<template>
    <MainWrapper>
    <div >
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="flex justify-between items-center e  p-4 rounded-lg shadow-md mb-6">
        <div class="flex space-x-6 text-gray-700 font-medium">
          <a href="#" class="border-b-2 border-red-600 pb-2 text-red-600">All Biodata</a>
          <a href="#" class="pb-2 hover:text-red-600 hover:border-red-600">Biodat No </a>
        </div>
        <div class="text-gray-600 text-sm">
          <h1 class="text-xl font-bold text-gray-800"> Biodata List</h1>
          <!-- <p>৭৮০৩ টি বায়োডাটা পাওয়া গেছে!</p> -->
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div v-for="biodata in paginatedBiodata" :key="biodata.id"
          class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center text-center">
          <div class="flex items-center justify-between w-full mb-4">
            <span class="text-sm font-semibold text-red-600">{{ biodata.id }}</span>
            <button class="text-gray-400 hover:text-red-600">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
          </div>
          <div class="w-24 h-24 rounded-full bg-red-100 mb-4 overflow-hidden flex items-center justify-center">
            <img :src="biodata.image" alt="" class="w-full  object-cover" v-if="biodata.image">
            <svg v-else class="w-16 h-16 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                clip-rule="evenodd"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-800 mb-1">{{ biodata.name }}</h3>
          <p class="text-sm text-gray-600 mb-2">Age - {{ biodata.age }}</p>
          <p class="text-sm text-gray-600 mb-2">height - {{ biodata.height }}</p>
          <p class="text-sm text-gray-600 mb-4">{{ biodata.description }}</p>
          <button @click="router.visit(route('matches.profile.view'))" class=" px-4 py-2 rounded-md bg-gradient-to-r from-[#f50536bf] to-[#260000b8] text-white transition duration-200">
            <i class="bi bi-eye-fill"></i> View Details
          </button>
        </div>
      </div>

      <div class="flex justify-center items-center space-x-2">
        <button @click="prevPage" :disabled="currentPage === 1"
          class="p-2 rounded-full text-gray-500 hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>
        <button v-for="page in totalPages" :key="page" @click="goToPage(page)"
          class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-medium transition duration-200"
          :class="{ 'bg-red-600 text-white': currentPage === page, 'bg-gray-200 text-gray-700 hover:bg-gray-300': currentPage !== page }">
          {{ page }}
        </button>
        <button @click="nextPage" :disabled="currentPage === totalPages"
          class="p-2 rounded-full text-gray-500 hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
      </div>
    </main></div>

    </MainWrapper>
</template>