<script setup>
import MainWrapper from './MainWrapper.vue';
import { ref, computed, onMounted, reactive } from 'vue'
import { router, usePage ,useForm} from '@inertiajs/vue3'
import { ElNotification } from 'element-plus'
const preview = ref(null)
const page = usePage()

const flashSuccess = computed(() => page.props.flash?.success)

const profile = computed(() => page.props.profile)
onMounted(() => {
    if (flashSuccess.value) {
        ElNotification({
            title: 'Success',
            message: flashSuccess.value,
            type: 'success',
            duration: 6000,
        })
    }
    if (profile.value) {
        Object.keys(form).forEach((key) => {
            form[key] = profile.value[key] || ''
        })
    }
})
function handleFileChange(e) {
    const file = e.target.files[0]
    if (file) {
        const reader = new FileReader()
        reader.onload = () => {
            preview.value = reader.result
        }
        reader.readAsDataURL(file)

        const formData = new FormData()
        formData.append('image', file)

        router.post('/user/upload-profile-image', formData, {
            preserveScroll: true,
            onSuccess: () => {
                ElNotification({
                    title: 'Success',
                    message: 'Preferences updated successfully!',
                    type: 'success',
                    duration: 3000,
                });
            },
        })
    }
}



const openModal = ref(false)

const months = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
]

const cities = ['Dhaka', 'Chittagong', 'Rajshahi', 'Khulna', 'Barisal', 'Sylhet', 'Rangpur', 'Mymensingh']
const religions = ['Islam', 'Hinduism', 'Christianity', 'Buddhism', 'Other']

const currentYear = new Date().getFullYear()
const years = Array.from({ length: 100 }, (_, i) => currentYear - i)

const form = reactive({
    name: '',
    bio: '',
    birthday: '',
    city: '',
    religion: '',

    description: profile.value?.description || '',
    height: '',
    weight: '',
    bloodGroup: '',
    bodyType: '',
    complexion: '',
    education_level: '',
    educationInstitute: '',
    education_year: '',
    profession: '',
    position: '',
    monthlyIncome: '',
    accountFor: '',
    gender: '',
    marritalStatus: '',
    natinality: '',
    birthPlace: '',
    familyStatus: '',
    livingWithfamily: '',
    smoking: '',
    dringking: '',



})


onMounted(() => {
  if (profile.value) {
    form.educationInstitute = profile.value.institute_name || ''
    form.education_year = profile.value.education_year || ''
    
    form.designation = profile.value.position || ''
    form.monthlyIncome = profile.value.monthly_income || ''
    form.accountFor = profile.value.account_for || ''
    
  }
})

function submitPorfileForm() {
    router.post('/user/profile/update/one', {
        name: form.name,
        bio: form.bio,
        date_of_birth: `${form.year}-${form.month}-${form.day}`,
        city: form.city,
        religion: form.religion,
    }, {
        onSuccess: () => {
            ElNotification({
                title: 'Success',
                message: 'Profile updated successfully!',
                type: 'success',
                duration: 3000,
            });
            openModal.value = false
        },
        preserveScroll: true,
    })


}

// save description
function saveDescription() {
  router.post('/user/profile/update/description', {
    description: form.description
  }, {
     onSuccess: () => {
            ElNotification({
                title: 'Success',
                message: 'Profile updated successfully!',
                type: 'success',
                duration: 3000,
            });
            AboutYourself.value = false
        },
        preserveScroll: true,
  })
}
// save personal information
function savePersonalInformation() {
    router.post('/user/profile/update/personal-info', {
        height: form.height,
        weight: form.weight,
        bloodGroup: form.bloodGroup,
        bodyType: form.bodyType,
        complexion: form.complexion,
        education: form.education,
        educationInstitute: form.educationInstitute,
        education_year: form.education_year,
        profession: form.profession,
        position: form.position,
        monthlyIncome: form.monthlyIncome,
        accountFor: form.accountFor,
        gender: form.gender,
        marritalStatus: form.marritalStatus,
        natinality: form.natinality,
        birthPlace: form.birthPlace,
        familyStatus: form.familyStatus,
        livingWithfamily: form.livingWithfamily,
        smoking: form.smoking,
        dringking: form.dringking,
    }, {
        onSuccess: () => {
            ElNotification({
                title: 'Success',
                message: 'Personal information updated successfully!',
                type: 'success',
                duration: 3000,
            });
            personalInformation.value = false
        },
    })

}




// define a reactive object to hold the form data
const AboutYourself = ref(false);
const personalInformation = ref(false);


</script>
<template>
    <MainWrapper>
        <section class="mx-auto  md:w-1/1">
            <div class=" mt-5 p-8 max-w-6xl mx-auto rounded-md  border border-red-300 font-sans">
                <div class=" bg-red-400 text-white rounded-lg p-6 flex gap-6 items-start">
                    <!-- Profile Image -->
                    <div class="relative">
                        <!-- Image Preview -->
                        <div class="w-32 h-32 rounded-lg bg-white flex items-center justify-center overflow-hidden">
                            <svg v-if="!preview" class="w-20 h-20 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v2h20v-2c0-3.3-6.7-5-10-5z" />
                            </svg>
                            <img v-else :src="preview" alt="Preview" class="w-full h-full object-cover rounded-lg" />
                        </div>

                        <!-- Upload Button -->
                        <button type="button" @click="$refs.fileInput.click()"
                            class="absolute bottom-1 right-1 bg-white text-red-400 rounded-full p-1 shadow hover:scale-105 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M5 20h14v-2H5v2zm7-9l5 5h-3v4h-4v-4H7l5-5zM12 2L6.5 7.5h3V14h3V7.5h3L12 2z" />
                            </svg>
                        </button>

                        <!-- Hidden File Input -->
                        <input type="file" ref="fileInput" accept="image/*" class="hidden" @change="handleFileChange" />
                    </div>

                    <!-- User Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <h2 class="text-xl font-bold">{{ profile.name }} </h2>
                            <span class="cursor-pointer underline" @click="openModal = true">Change</span>
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828zM5 14h10v2H5v-2z" />
                            </svg>
                        </div>

                        <p class="mt-1">- {{ profile.bio }}</p>

                        <hr class="my-3 border-red-400">

                        <!-- Details Grid -->
                        <div class="grid grid-cols-2 gap-4 ">
                            <div class="flex gap-2">
                                <span class="font-semibold">Birthday :</span>
                                <span>{{ profile.date_of_birth }}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="font-semibold">City :</span>
                                <span>{{ profile.location }}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="font-semibold">Religion :</span>
                                <span>{{ profile.religion }}</span>
                            </div>
                        </div>



                    </div>
                </div>




                <div class="bg-gray-200 rounded-lg p-4 gap-5 my-5">
                    <div class="flex justify-between items-center text-red-600 font-semibold">
                        <div>My photos</div>
                        <div class="flex items-center gap-3">
                            <button class="flex items-center gap-1 hover:underline">
                                Change <i class="fas fa-pen text-xs"></i>
                            </button>
                            <button class="flex items-center gap-1 hover:underline">
                                Show <i class="fas fa-eye-slash text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Contact Information Section -->
                <div class="bg-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-center text-red-600 font-semibold">
                        <div>Contact Information</div>
                        <div class="flex items-center gap-3">
                            <button class="flex items-center gap-1 hover:underline">
                                Change <i class="fas fa-pen text-xs"></i>
                            </button>
                            <button class="flex items-center gap-1 hover:underline">
                                Hide <i class="fas fa-eye text-xs"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3 flex gap-4 flex-wrap">
                        <span class="bg-white px-3 py-1 rounded-full shadow text-gray-800">Email:</span>
                        <span class="bg-white px-3 py-1 rounded-full shadow text-gray-800">Phone: +880
                            01518987898</span>
                    </div>
                </div>


                <!-- Freely About Yourself Section -->
                <div class="bg-gray-200 rounded-lg p-4 my-5">
                    <div class="flex justify-between items-center text-red-600 font-semibold">
                        <div>Freely about yourself</div>
                        <button @click="AboutYourself = !AboutYourself" class="flex items-center gap-1 hover:underline">
                            <span v-if="!AboutYourself">Change</span>
                            <span v-else>Cancel</span>
                            <i class="fas fa-pen text-xs"></i>
                        </button>
                    </div>

                    <!-- View Mode -->
                    <p v-if="!AboutYourself" class="mt-3 text-gray-700">
                        {{ profile.desc || 'Write a short description about yourself!' }}
                    </p>

                    <!-- Edit Mode -->
                    <div v-else class="mt-3">
                        <textarea v-model="form.description" class="w-full p-2 rounded-md" rows="3"></textarea>
                        <button @click="saveDescription"
                            class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Save
                        </button>
                    </div>
                </div>


                <!-- ddd -->
                <div class="bg-gray-200 p-6 rounded-lg max-w-6xl mx-auto  space-y-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center text-red-600 font-semibold">
                        <span>Personal Information</span>
                        <button @click="personalInformation = !personalInformation"
                            class="flex items-center gap-1 hover:underline">
                            <span v-if="!personalInformation">Change</span>
                            <span v-else>Cancel</span>
                            <i class="fas fa-pen text-xs"></i>
                        </button>
                    </div>

                    <!-- Appearance -->
                    <div>
                        <h2 class="font-bold mb-2">Appearance</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label>Height</label>
                                <template v-if="personalInformation">
                                    <input v-model="form.height" type="text" class="w-full p-2 border rounded">
                                </template>
                                <p v-else class="text-gray-600">{{ profile.height || 'Please Select' }}</p>
                            </div>
                            <div>
                                <label>Weight</label>
                                <template v-if="personalInformation">
                                    <input v-model="form.weight" type="text" class="w-full p-2 border rounded">
                                </template>
                                <p v-else class="text-gray-600">{{ profile.weight || 'Please Select' }}</p>
                            </div>
                            <div>
                                <label>Blood Group</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.bloodGroup" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>A+</option>
                                        <option>B+</option>
                                        <option>AB+</option>
                                        <option>O+</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600">{{ profile.blood_group || 'Please Select' }}</p>
                            </div>
                            <div>
                                <label class="">Body Type</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.bodyType" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>Slim</option>
                                        <option>Extra slim</option>
                                        <option>Mediam</option>
                                        <option>healthday</option>
                                        <option>Over Weight</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600">{{ profile.body_type || 'Please Select' }}</p>
                            </div>
                            <div>
                                <label class="">Complexion</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.complexion" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>Fair Skin</option>
                                        <option>Mediam slim</option>
                                        <option>light brown</option>
                                        <option>Black</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600">{{ profile.complexion || 'Please Select' }}</p>
                            </div>
                        </div>
                        <hr class="border-red-500 mt-4">
                    </div>

                    <!-- Education -->
                    <div>
                        <h2 class="font-bold mb-2">Education</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label>Educational Level</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.education_level" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>High School</option>
                                        <option>Diploma</option>
                                        <option>Bachelor's</option>
                                        <option>Master's</option>
                                        <option>PhD</option>
                                        <option>Other</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600">{{ form.education_level || 'Please Select' }}</p>
                            </div>
                            <div>
                                <label>Education Institute</label>
                                <input v-model="form.educationInstitute" type="text" class="w-full p-2 rounded border" :readonly="!personalInformation" />
                            </div>
                            <div>
                                <label>Year</label>
                                <input v-model="form.education_year" type="text" class="w-full p-2 rounded border" :readonly="!personalInformation" />
                            </div>
                        </div>
                        <hr class="border-red-500 mt-4">
                    </div>

                    <!-- Work -->
                    <div>
                        <h2 class="font-bold mb-2">Work</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label>Profession</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.profession" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>Private Company</option>
                                        <option>Business</option>
                                        <option>Govt. service</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600">{{ form.profession || 'Please Select' }}</p>
                            </div>
                            <div>
                                <label>Position</label>
                                <input v-model="designation"  type="text" class="w-full p-2 rounded border" :readonly="!personalInformation" />
                            </div>
                            <div>
                                <label>Your Income (Monthly)</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.monthlyIncome" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>10,00-20,000</option>
                                        <option>20,000-30,000</option>
                                        <option>30,000-40,000</option>
                                        <option>40,000-50,000</option>
                                        <option>50,000-60,000</option>
                                        <option>60,000-70,000</option>
                                        <option>70,000-80,000</option>
                                        <option>80,000-90,000</option>
                                        <option>90,000-1,00,000</option>
                                        <option>1,00,000+</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600">{{ form.monthlyIncome || 'Please Select' }}</p>
                            </div>
                        </div>
                        <hr class="border-red-500 mt-4">
                    </div>

                    <!-- General -->
                    <div>
                        <h2 class="font-bold mb-2">General</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label>Account For</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.accountFor" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>Slef</option>
                                        <option>Others</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600">{{ form.accountFor || 'Please Select' }}</p>
                            </div>
                            <div>
                                <label>Gender</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.gender" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600"> </p>
                            </div>
                            <div>
                                <label>Marital Status</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.marritalStatus" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>Single</option>
                                        <option>Divorsed</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600"> </p>
                            </div>
                            <div>
                                <label>Nationality</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.natinality" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>Bangladesh</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600"> </p>
                            </div>
                            <div>
                                <label>Birth Place</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.birthPlace" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>Dhaka</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600"> </p>
                            </div>
                            <div>
                                <label>Family Status</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.familyStatus" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>Dhaka</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600"> </p>
                            </div>
                            <div>
                                <label class="underline text-red-600">Living With Family ?</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.livingWithfamily" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>yes</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600"> </p>
                            </div>
                            <div>
                                <label>Smoking</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.smoking" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>yes</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600"> </p>

                            </div>
                            <div>
                                <label>Drinking</label>
                                <template v-if="personalInformation">
                                    <select v-model="form.dringking" class="w-full p-2 border rounded">
                                        <option value="">Please Select</option>
                                        <option>yes</option>
                                    </select>
                                </template>
                                <p v-else class="text-gray-600"> </p>

                            </div>
                        </div>
                    </div>
                    <div v-if="personalInformation" class="flex justify-end">
                        <button @click="savePersonalInformation"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md font-semibold">
                            Save
                        </button>
                    </div>
                </div>


                <div class="bg-gray-200 rounded-md p-4 flex flex-wrap items-center gap-2 my-5">
                    <div class="text-red-600 font-semibold mr-1">I'm looking for</div>
                    <button class="text-red-600 underline flex items-center gap-1">
                        Change
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536M9 13l6.536-6.536a2 2 0 112.828 2.828L11.828 15.828a4 4 0 01-1.414.828l-4.243 1.414 1.414-4.243a4 4 0 01.828-1.414z" />
                        </svg>
                    </button>

                    <!-- Filters -->
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Bride</div>
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Age : yr - 22yr</div>
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Islam</div>
                    <span class="text-gray-600">—</span>
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Dhaka</div>
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Secondary Education</div>
                    <div class="bg-blue-100 text-black px-2 py-1 rounded-full">Height : 4.0' Inch - 4.5' Inch</div>
                </div>



            </div>


            <!-- ============ -->

            <!-- Modal -->

            <div v-if="openModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-[#f54266] text-white p-6 rounded-xl w-[380px] sm:w-[500px] relative">
                    <!-- Close button -->
                    <button @click="openModal = false"
                        class="absolute top-2 right-2 text-white text-xl font-bold bg-[#f76a8c] hover:bg-[#e44e6f] rounded-full w-8 h-8 flex items-center justify-center">
                        &times;
                    </button>

                    <h2 class="text-xl font-bold text-center mb-6">Update Profile Details</h2>

                    <form @submit.prevent="submitPorfileForm" class="space-y-4">
                        <!-- Name and Bio -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label>Name</label>
                                <input v-model="form.name" type="text" class="w-full rounded-md px-3 py-2 text-black" />
                            </div>
                            <div>
                                <label>Bio</label>
                                <input v-model="form.bio" type="text" class="w-full rounded-md px-3 py-2 text-black" />
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label class="block mb-1">Date of Birth</label>
                            <div class="grid grid-cols-3 gap-4 mt-1">
                                <!-- Day -->
                                <select v-model="form.day" class="w-full rounded-md px-3 py-2 text-[#534d4d]">
                                    <option value="" disabled class="text-gray-400">Day</option>
                                    <option v-for="d in 31" :key="d" :value="String(d).padStart(2, '0')">
                                        {{ d }}
                                    </option>
                                </select>

                                <!-- Month -->
                                <select v-model="form.month" class="w-full rounded-md px-3 py-2 text-[#534d4d]">
                                    <option value="" disabled>Month</option>
                                    <option v-for="(month, index) in months" :key="index"
                                        :value="String(index + 1).padStart(2, '0')">
                                        {{ month }}
                                    </option>
                                </select>

                                <!-- Year -->
                                <select v-model="form.year" class="w-full rounded-md px-3 py-2 text-[#534d4d]">
                                    <option value="" disabled>Year</option>
                                    <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                                </select>
                                <div>
                                </div>
                            </div>
                        </div>

                        <!-- Location and Religion -->
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Location Select -->
                            <div>
                                <label>Location</label>
                                <select v-model="form.city" class="w-full rounded-md px-3 py-2 text-[#534d4d]">
                                    <option value="" disabled>Select City</option>
                                    <option v-for="city in cities" :key="city" :value="city">{{ city }}</option>
                                </select>
                            </div>

                            <!-- Religion Select -->
                            <div>
                                <label>Religion</label>
                                <select v-model="form.religion" class="w-full rounded-md px-3 py-2 text-[#534d4d]">
                                    <option value="" disabled>Select Religion</option>
                                    <option v-for="religion in religions" :key="religion" :value="religion">{{ religion
                                        }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-white text-[#f54266] font-semibold py-2 rounded-md">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </section>

    </MainWrapper>
</template>
