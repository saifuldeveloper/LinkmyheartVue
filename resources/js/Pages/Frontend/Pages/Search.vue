<script setup>
import Footer from '../Layouts/Footer.vue';
import Navbar from '../Layouts/Navbar.vue';


import { ref, reactive, computed } from 'vue';

// Filter State (reactive data for user selections)
const filters = reactive({
  youAre: '',
  division: '',
  maritalStatus: '',
  ageRange: [18, 50], // Initial min and max age for the slider
});

// State for controlling the open/closed state of filter sections (accordion)
const primaryFilterOpen = ref(true); // Assuming 'প্রাথমিক' is open by default
const maritalStatusFilterOpen = ref(true); // Assuming 'বৈবাহিক অবস্থা' is open by default

// Reactive object to manage the open state of other filter sections
const openSections = reactive({
  address: false,
  education: false,
  personal: false,
  profession: false,
  other: false,
});

// Data for iterating and rendering other filter sections
const otherFilterSections = [
  { key: 'address', name: 'Address' },
  { key: 'education', name: 'Education' },
  { key: 'personal', name: 'Personal' },
  { key: 'profession', name: 'Profession' },
  { key: 'other', name: 'Other' },
];

// Function to toggle the open/closed state of a filter section
const toggleFilterSection = (sectionKey) => {
  if (sectionKey === 'primary') {
    primaryFilterOpen.value = !primaryFilterOpen.value;
  } else if (sectionKey === 'maritalStatus') {
    maritalStatusFilterOpen.value = !maritalStatusFilterOpen.value;
  } else {
    openSections[sectionKey] = !openSections[sectionKey];
  }
};

// Biodata Data (Example Data - in a real app, this would come from an API)
const allBiodata = ref([
  {
    id: 'ODM-1477',
    name: 'Sabina',
    age: 26,
    height: '5\' 4\'\'',
    description: 'Dhaka - Mirpur',
    image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P1', // Placeholder image
  },
  {
    id: 'ODF-16889',
    name:  'Joyi',
    age: 22,
    height: '5\' 1\'\'',
    description: 'Purb - Faridpur',
    image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P2',
  },
  {
    id: 'ODF-20999',
    name: 'Tania',
    age: 25,
    height: '5\' 0\'\'',
    description: 'Purb - Chittagong',
    image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P3',
  },
  {
    id: 'ODM-1127',
    name: 'Hasan',
    age: 28,
    height: '5\' 4\'\'',
    description: 'Dhaka - Mirpur',
    image: '', // Example with no image
  },
  {
    id: 'ODF-10359',
    name: 'Shina',
    age: 24,
    height: '5\' 2\'\'',
    description: 'Purb - Faridpur',
    image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P5',
  },
  {
    id: 'ODM-14221',
    name: 'Rahim',
    age: 26,
    height: '5\' 0\'\'',
    description: 'Dhaka - Mirpur',
    image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P6',
  },
  {
    id: 'ODF-21633',
    name: 'Sathi',
    age: 21,
    height: '5\' 6\'\'',
    description: 'Purb - Chittagong',
    image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P7',
  },
  {
    id: 'ODF-21656',
    name: 'Nasreen',
    age: 21,
    height: '5\' 1\'\'',
    description: 'Purb - Chittagong',
    image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P8',
  },
  {
    id: 'ODF-16442',
    name: 'Purb - Ulla',
    age: 20,
    height: '5\' 5\'\'',
    description: 'Purb - Chittagong',
    image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P9',
  },
  {
    id: 'ODM-1001',
    name: 'মোঃ রনি',
    age: 30,
    height: '5\' 6\'\'',
    description: 'barishal - sadar',
    image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P10',
  },
  {
    id: 'ODF-22001',
    name: 'Sumona',
    age: 23,
    height: '5\' 3\'\'',
    description: 'Dhaka - Banani',
    image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P11',
  },
  {
    id: 'ODM-15002',
    name: 'Sabbir',
    age: 27,
    height: '5\' 7\'\'',
    description: 'Dhaka - Uttara',
    image: 'https://via.placeholder.com/150/FF69B4/FFFFFF?text=P12',
  },
]);

// Pagination Logic
const itemsPerPage = 9; // Display 9 items per page (3 rows of 3 cards)
const currentPage = ref(1); // Current active page

// Computed property to calculate total number of pages
const totalPages = computed(() => {
  return Math.ceil(allBiodata.value.length / itemsPerPage);
});

// Computed property to get biodata for the current page
const paginatedBiodata = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return allBiodata.value.slice(start, end);
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
  <div class="about-section  bg-[#fac0c0] position-relative">
    <!-- Navbar -->
    <Navbar />
    <hr class="top-Header-bottom-border" />
  </div>
  <div class="bg-gradient-to-b  flex h-screenfont-sans px-10 mx-auto">
    
      <aside class="w-72   shadow-md overflow-y-auto flex-shrink-0 p-4">
        <div class="mb-8">
          <h2 class="text-xl font-bold text-gray-800 mb-4">Filters</h2>
        </div>

        <div class="mb-6 border-b border-gray-200 pb-4">
          <button @click="toggleFilterSection('primary')"
            class="flex items-center justify-between w-full text-lg font-semibold text-gray-700 mb-4 focus:outline-none">
             Frist
            <svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
              :class="{ 'rotate-180': primaryFilterOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
            </svg>
          </button>
          <div v-if="primaryFilterOpen" class="space-y-4">
            <div>
              <label for="you_are" class="block text-sm font-medium text-gray-600 mb-1">looking for?</label>
              <select id="you_are" v-model="filters.youAre"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm text-gray-700">
                <option value="">Select</option>
                <option value="male">Bride</option>
                <option value="female">Groom</option>
              </select>
            </div>
            <div>
              <label for="division" class="block text-sm font-medium text-gray-600 mb-1">Division</label>
              <select id="division" v-model="filters.division"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm text-gray-700">
                <option value="">Select</option>
                <option value="dhaka">Dhaka</option>
                <option value="chittagong">Barisal</option>
              </select>
            </div>
          </div>
        </div>

        <div class="mb-6 border-b border-gray-200 pb-4">
          <button @click="toggleFilterSection('maritalStatus')"
            class="flex items-center justify-between w-full text-lg font-semibold text-gray-700 mb-4 focus:outline-none">
           Marrital Status
            <svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
              :class="{ 'rotate-180': maritalStatusFilterOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
            </svg>
          </button>
          <div v-if="maritalStatusFilterOpen" class="space-y-4">
            <div>
              <label for="status" class="block text-sm font-medium text-gray-600 mb-1">Status</label>
              <select id="status" v-model="filters.maritalStatus"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm text-gray-700">
                <option value="">Select</option>
                <option value="single">Married</option>
                <option value="married">Unmarried</option>
              </select>
            </div>
            <div>
              <label for="age-range" class="block text-sm font-medium text-gray-600 mb-2">Age</label>
              <div class="flex items-center justify-between text-gray-700 text-sm mb-2">
                <span>{{ filters.ageRange[0] }}</span>
                <span>{{ filters.ageRange[1] }}</span>
              </div>
              <input type="range" id="age-range" min="18" max="50" v-model.number="filters.ageRange[0]"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer range-sm accent-red-600" />
            </div>
          </div>
        </div>

        <div v-for="(section, index) in otherFilterSections" :key="index" class="mb-6 border-b border-gray-200 pb-4">
          <button @click="toggleFilterSection(section.key)"
            class="flex items-center justify-between w-full text-lg font-semibold text-gray-700 focus:outline-none">
            {{ section.name }}
            <svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
              :class="{ 'rotate-180': openSections[section.key] }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          <div v-if="openSections[section.key]" class="mt-4 text-gray-600 text-sm">
            <p>Filter options for {{ section.name }}...</p>
          </div>
        </div>
      </aside>


    

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
          <button class=" px-4 py-2 rounded-md bg-gradient-to-r from-[#f50536bf] to-[#260000b8] text-white transition duration-200">
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
    </main>
  
  </div>
  <!-- Footer -->
  <Footer />

</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 4px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 4px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
