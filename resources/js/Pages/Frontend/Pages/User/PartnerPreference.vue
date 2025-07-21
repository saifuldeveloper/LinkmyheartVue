<script setup>
import MainWrapper from './MainWrapper.vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { ElNotification } from 'element-plus'
import { computed, onMounted } from 'vue'
import { Inertia } from '@inertiajs/inertia'
const page = usePage()

const preference = page.props.preference || {}

const form = useForm({
    looking_for: preference.looking_for || '',
    from_age: preference.from_age || '',
    to_age: preference.to_age || '',
    marital_status: preference.marital_status || '',
    religion: preference.religion || '',
    location: preference.location || '',
    education: preference.education || '',
    height_from: preference.height_from || '',
    height_to: preference.height_to || '',
})



const flashSuccess = computed(() => page.props.flash?.success)

onMounted(() => {
    if (flashSuccess.value) {
        ElNotification({
            title: 'Success',
            message: flashSuccess.value,
            type: 'success',
            duration: 6000,
        })
    }
})


const submit = () => {
    form.post('/user/partner-preference/update', {
        onSuccess: () => {
            ElNotification({
                title: 'Success',
                message: 'Preferences updated successfully!',
                type: 'success',
                duration: 3000,
            });
            setTimeout(() => {
                Inertia.visit('/user/profile')
            }, 5000)

        },
    })
}

const ages = Array.from({ length: 80 }, (_, i) => i + 18)

const heights = [
    `4'0"`, `4'1"`, `4'2"`, `4'3"`, `4'4"`, `4'5"`, `4'6"`, `4'7"`, `4'8"`, `4'9"`, `4'10"`,
    `4'11"`, `5'0"`, `5'1"`, `5'2"`, `5'3"`, `5'4"`, `5'5"`, `5'6"`, `5'7"`, `5'8"`, `5'9"`, `5'10"`, `5'11"`, `6'0"`,
]
</script>

<template>
    <MainWrapper>
        <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow rounded">
            <h2 class="text-2xl font-semibold mb-4">Partner Preference</h2>

            <!-- ✅ Flash Success -->
            <div v-if="flashSuccess" class="mb-4 text-green-700 bg-green-100 p-2 rounded">
                {{ flashSuccess }}
            </div>

            <form @submit.prevent="submit" class="space-y-6">

                <!-- Looking For -->
                <div>
                    <label class="font-semibold">Looking For</label>
                    <select v-model="form.looking_for" class="w-full p-2 border rounded bg-red-100">
                        <option disabled value="">Select</option>
                        <option>Bride</option>
                        <option>Groom</option>
                    </select>
                    <span v-if="form.errors.looking_for" class="text-red-600">{{ form.errors.looking_for }}</span>
                </div>

                <!-- Age -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold">From Age</label>
                        <select v-model="form.from_age" class="w-full p-2 border rounded bg-red-100">
                            <option disabled value="">Select</option>
                            <option v-for="age in ages" :key="age" :value="age">{{ age }}</option>
                        </select>
                        <span v-if="form.errors.from_age" class="text-red-600">{{ form.errors.from_age }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">To Age</label>
                        <select v-model="form.to_age" class="w-full p-2 border rounded bg-red-100">
                            <option disabled value="">Select</option>
                            <option v-for="age in ages" :key="'to-' + age" :value="age">{{ age }}</option>
                        </select>
                        <span v-if="form.errors.to_age" class="text-red-600">{{ form.errors.to_age }}</span>
                    </div>
                </div>

                <!-- Marital Status -->
                <div>
                    <label class="font-semibold">Marital Status</label>
                    <select v-model="form.marital_status" class="w-full p-2 border rounded bg-red-100">
                        <option disabled value="">Select</option>
                        <option>Single</option>
                        <option>Divorced</option>
                        <option>Widowed</option>
                        <option>Awaiting Divorce</option>
                    </select>
                    <span v-if="form.errors.marital_status" class="text-red-600">{{ form.errors.marital_status }}</span>
                </div>

                <!-- Religion -->
                <div>
                    <label class="font-semibold">Religion</label>
                    <select v-model="form.religion" class="w-full p-2 border rounded bg-red-100">
                        <option disabled value="">Select</option>
                        <option>Islam</option>
                        <option>Hinduism</option>
                        <option>Christianity</option>
                        <option>Buddhism</option>
                        <option>Judaism</option>
                        <option>Other</option>
                    </select>
                    <span v-if="form.errors.religion" class="text-red-600">{{ form.errors.religion }}</span>
                </div>

                <!-- Location -->
                <div>
                    <label class="font-semibold">Location</label>
                    <select v-model="form.location" class="w-full p-2 border rounded bg-red-100">
                        <option disabled value="">Select</option>
                        <option>Dhaka</option>
                        <option>Chittagong</option>
                        <option>Khulna</option>
                        <option>Rajshahi</option>
                        <option>Sylhet</option>
                        <option>Barisal</option>
                        <option>Rangpur</option>
                        <option>Mymensingh</option>
                        <option>Other</option>
                    </select>
                    <span v-if="form.errors.location" class="text-red-600">{{ form.errors.location }}</span>
                </div>

                <!-- Education -->
                <div>
                    <label class="font-semibold">Education</label>
                    <select v-model="form.education" class="w-full p-2 border rounded bg-red-100">
                        <option disabled value="">Select</option>
                        <option>High School</option>
                        <option>Diploma</option>
                        <option>Bachelor's</option>
                        <option>Master's</option>
                        <option>PhD</option>
                        <option>Other</option>
                    </select>
                    <span v-if="form.errors.education" class="text-red-600">{{ form.errors.education }}</span>
                </div>

                <!-- Height -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold">Height From</label>
                        <select v-model="form.height_from" class="w-full p-2 border rounded bg-red-100">
                            <option disabled value="">Select</option>
                            <option v-for="h in heights" :key="'from-' + h" :value="h">{{ h }}</option>
                        </select>
                        <span v-if="form.errors.height_from" class="text-red-600">{{ form.errors.height_from }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Height To</label>
                        <select v-model="form.height_to" class="w-full p-2 border rounded bg-red-100">
                            <option disabled value="">Select</option>
                            <option v-for="h in heights" :key="'to-' + h" :value="h">{{ h }}</option>
                        </select>
                        <span v-if="form.errors.height_to" class="text-red-600">{{ form.errors.height_to }}</span>
                    </div>
                </div>

                <!-- Submit -->
                <div class="text-right">
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Save</button>
                </div>

            </form>
        </div>
    </MainWrapper>
</template>