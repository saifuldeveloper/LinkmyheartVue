<script setup>
import MainWrapper from './MainWrapper.vue';
import { ref } from 'vue'


</script>
<template>
    <MainWrapper>
       <section class="max-md mx-auto  md:w-1/1">
                <div class=" mt-5 p-8 max-w-6xl mx-auto rounded-md  border border-red-300 font-sans">
                    <h2 class="text-2xl font-semibold mb-6">
                      Update Contact Informations
                    </h2>
                    <div class="mb-6 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold mb-1">Email</label>
                            <input type="text" v-model="location"
                                class="w-full p-2 rounded border bg-red-200  border-red-300" placeholder="Email" />
                        </div>
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

    </MainWrapper>
</template>
