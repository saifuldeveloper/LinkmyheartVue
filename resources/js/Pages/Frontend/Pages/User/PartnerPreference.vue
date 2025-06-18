<template>
    <div class="bg-pink-600 p-8 max-w-4xl mx-auto rounded-md text-white font-sans">
        <h2 class="text-2xl font-semibold mb-6">
            Tell Us About Your Ideal Match Partner Preference ...
        </h2>

        <!-- Looking For -->
        <div class="mb-6">
            <label class="block mb-1 font-semibold">Looking For</label>
            <div class="flex space-x-4">
                <button
                    :class="['px-4 py-1 rounded-full border border-white', lookingFor === 'Groom' ? 'bg-white text-pink-600' : '']"
                    @click="lookingFor = 'Groom'">
                    Groom
                </button>
                <button
                    :class="['px-4 py-1 rounded-full border border-white', lookingFor === 'Bride' ? 'bg-white text-pink-600' : '']"
                    @click="lookingFor = 'Bride'">
                    Bride
                </button>
            </div>
        </div>

        <!-- Partners Age -->
        <div class="mb-6 grid grid-cols-2 gap-4 max-w-md">
            <label class="block col-span-2 font-semibold">Partners Age (Optional)</label>
            <select v-model="ageFrom" class="p-2 rounded border border-white bg-pink-600 text-white">
                <option disabled value="">Please Select</option>
                <option v-for="age in ages" :key="'from-' + age" :value="age">{{ age }}</option>
            </select>
            <input type="number" v-model="ageTo" class="p-2 rounded border border-white bg-pink-600 text-white"
                placeholder="to" />
        </div>

        <!-- Marital Status & Religion -->
        <div class="mb-6 grid grid-cols-2 gap-4 max-w-lg">
            <div>
                <label class="block font-semibold mb-1">Marital Status (Optional)</label>
                <select v-model="maritalStatus" class="w-full p-2 rounded border border-white bg-pink-600 text-white">
                    <option disabled value="">Select Marital Status</option>
                    <option>Single</option>
                    <option>Divorced</option>
                    <option>Widowed</option>
                    <option>Separated</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Religion</label>
                <input type="text" v-model="religion"
                    class="w-full p-2 rounded border border-white bg-pink-600 text-white" placeholder="Religion" />
            </div>
        </div>

        <!-- Location & Education Level -->
        <div class="mb-6 grid grid-cols-2 gap-4 max-w-lg">
            <div>
                <label class="block font-semibold mb-1">Location (optional)</label>
                <input type="text" v-model="location"
                    class="w-full p-2 rounded border border-white bg-pink-600 text-white" placeholder="Location" />
            </div>
            <div>
                <label class="block font-semibold mb-1">Educational Level (optional)</label>
                <input type="text" v-model="education"
                    class="w-full p-2 rounded border border-white bg-pink-600 text-white"
                    placeholder="Educational Level" />
            </div>
        </div>

        <!-- Partners Height -->
        <div class="mb-6 grid grid-cols-2 gap-4 max-w-md">
            <label class="block col-span-2 font-semibold">Partners Height (optional)</label>
            <select v-model="heightFrom" class="p-2 rounded border border-white bg-pink-600 text-white">
                <option disabled value="">Please Select</option>
                <option>4'0"</option>
                <option>4'1"</option>
                <option>4'2"</option>
                <!-- add more heights as needed -->
            </select>
            <select v-model="heightTo" class="p-2 rounded border border-white bg-pink-600 text-white">
                <option disabled value="">Please Select</option>
                <option>5'0"</option>
                <option>5'1"</option>
                <option>5'2"</option>
                <!-- add more heights as needed -->
            </select>
        </div>

        <!-- Save Button -->
        <div class="text-right">
            <button class="bg-white text-pink-600 rounded-full px-6 py-2 font-semibold hover:bg-pink-100 transition">
                Save
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const lookingFor = ref('Bride')

const ages = Array.from({ length: 50 }, (_, i) => i + 18) // ages 18 to 67

const ageFrom = ref('')
const ageTo = ref('22')

const maritalStatus = ref('')
const religion = ref('Islam')
const location = ref('Dhaka')
const education = ref('Secondary Education')

const heightFrom = ref('')
const heightTo = ref('')
</script>

<style>
/* Optional: Add custom scrollbar styles or tweaks here */
</style>
