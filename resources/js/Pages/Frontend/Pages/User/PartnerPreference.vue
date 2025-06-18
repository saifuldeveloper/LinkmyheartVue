<script setup>
import MainWrapper from './MainWrapper.vue';
import { ref } from 'vue'

const lookingFor = ref('Bride')

const ages = Array.from({ length: 50 }, (_, i) => i + 18) // ages 18 to 67

const ageFrom = ref('')
const ageTo = ref('')

const maritalStatus = ref('')
const religion = ref('Islam')
const location = ref('Dhaka')
const education = ref('Secondary Education')

const heightFrom = ref('')
const heightTo = ref('')
</script>
<template>
    <MainWrapper>
        <div>
            <section class="max-md mx-auto  md:w-1/1">
                <div class=" mt-5 p-8 max-w-6xl mx-auto rounded-md  border border-red-300 font-sans">
                    <h2 class="text-2xl font-semibold mb-6">
                        Tell Us About Your Ideal Match Partner Preference ...
                    </h2>

                    <!-- Looking For -->
                    <div class="mb-6">
                        <label class="block mb-1 font-semibold">Looking For</label>
                        <div class="flex space-x-4">
                            <button
                                :class="['px-5 py-1 rounded-full border border-red', lookingFor === 'Groom' ? 'bg-white text-white border-[#ddd] bg-gradient-to-r from-[#f50536bf] to-[#260000b8] px-4 py-2 rounded-full' : '']"
                                @click="lookingFor = 'Groom'">
                                Groom
                            </button>
                            <button
                                :class="['px-5 py-1 rounded-full border border-red', lookingFor === 'Bride' ? 'bg-white text-white border-[#ddd] bg-gradient-to-r from-[#f50536bf] to-[#260000b8] px-4 py-2 rounded-full' : '']"
                                @click="lookingFor = 'Bride'">
                                Bride
                            </button>
                        </div>
                    </div>

                    <!-- Partners Age -->
                    <div class="mb-6 grid grid-cols-2 gap-4 max-w-lg">
                        <label class="block col-span-2 font-semibold">Partners Age (Optional)</label>
                        <select v-model="ageFrom" class="p-2 rounded border border-red-300 bg-red-200 ">
                            <option disabled value="">Please Select</option>
                            <option v-for="age in ages" :key="'from-' + age" :value="age">{{ age }}</option>
                        </select>
                        <input type="number" v-model="ageTo" class="p-2 rounded border border-red-300 bg-red-200 "
                            placeholder="to" />
                    </div>

                    <!-- Marital Status & Religion -->
                    <div class="mb-6 grid grid-cols-2 gap-4 max-w-lg">
                        <div>
                            <label class="block font-semibold mb-1">Marital Status (Optional)</label>
                            <select v-model="maritalStatus" class="w-full p-2 rounded border border-red-300 bg-red-200 ">
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
                                class="w-full p-2 rounded border bg-red-200  border-red-300" placeholder="Religion" />
                        </div>
                    </div>

                    <!-- Location & Education Level -->
                    <div class="mb-6 grid grid-cols-2 gap-4 max-w-lg">
                        <div>
                            <label class="block font-semibold mb-1">Location (optional)</label>
                            <input type="text" v-model="location"
                                class="w-full p-2 rounded border bg-red-200  border-red-300" placeholder="Location" />
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Educational Level (optional)</label>
                            <input type="text" v-model="education"
                                class="w-full p-2 rounded border bg-red-200  border-red-300"
                                placeholder="Educational Level" />
                        </div>
                    </div>

                    <!-- Partners Height -->
                    <div class="mb-6 grid grid-cols-2 gap-4 max-w-lg">
                        <label class="block col-span-2 font-semibold">Partners Height (optional)</label>
                        <select v-model="heightFrom" class="p-2 rounded border bg-red-200  border-red-300">
                            <option disabled value="">Please Select</option>
                            <option>4'0"</option>
                            <option>4'1"</option>
                            <option>4'2"</option>
                            <!-- add more heights as needed -->
                        </select>
                        <select v-model="heightTo" class="p-2 rounded border bg-red-200  border-red-300">
                            <option disabled value="">Please Select</option>
                            <option>5'0"</option>
                            <option>5'1"</option>
                            <option>5'2"</option>
                            <!-- add more heights as needed -->
                        </select>
                    </div>

                    <!-- Save Button -->
                    <div class="text-right">
                        <button
                            class="text-white border-[#ddd] bg-gradient-to-r from-[#f50536bf] to-[#260000b8] px-4 py-2 rounded-full">
                            Save
                        </button>
                    </div>
                </div>
            </section>

        </div>

    </MainWrapper>
</template>
