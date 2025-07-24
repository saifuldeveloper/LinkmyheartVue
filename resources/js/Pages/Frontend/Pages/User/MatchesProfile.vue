<script setup>
import MainWrapper from './MainWrapper.vue';
import { ref, reactive, computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3'

import { ElNotification } from 'element-plus'

const page = usePage();
const authProfile = page.props.authProfile || {};
const viewProfile = page.props.viewProfile || {};

const aMatch = authProfile.user?.match || {};
const vMatch = viewProfile.user?.match || {};

const isReligionMatch = computed(() => vMatch.religion === aMatch.religion);
const isMaritalStatusMatch = computed(() => vMatch.marital_status === aMatch.marital_status);
const isAgeMatch = computed(() => (vMatch.from_age === aMatch.from_age && vMatch.to_age === aMatch.to_age));
const isEducationMatch = computed(() => vMatch.education === aMatch.education);
const isLocationMatch = computed(() => vMatch.location === aMatch.location);
const isHeightMatch = computed(() => (vMatch.height_from === aMatch.height_from && vMatch.height_to === aMatch.height_to));

const totalFields = 6; // Adjust if you add more

const matchedCount = computed(() => {
    let count = 0;
    if (isReligionMatch.value) count++;
    if (isMaritalStatusMatch.value) count++;
    if (isAgeMatch.value) count++;
    if (isEducationMatch.value) count++;
    if (isLocationMatch.value) count++;
    if (isHeightMatch.value) count++;
    return count;
});




const sending = ref(false);
const requestSent = ref(page.props.requestSent);
const requestReceived = ref(page.props.requestReceived);
const connected = ref(page.props.connected);
const connection = ref(page.props.connection || {});



const sendRequest = async (recipientId) => {
    sending.value = true;
    try {
        await router.post('/user/send-request', {
            recipient_id: recipientId
        }, {
            preserveScroll: true,
            onSuccess: () => {
                const message = page.props.flash?.message;
                if (message) {
                    ElNotification({
                        title: 'Success',
                        message: message,
                        type: 'success',
                        duration: 3000,
                    });
                    requestSent.value = true;
                    requestReceived.value = false;
                    connected.value = false;

                }
            }
        });
    } catch (error) {
        ElNotification({
            title: 'Error',
            message: 'Something went wrong',
            type: 'error',
            duration: 3000,
        });
    } finally {
        sending.value = false;
    }
};
// cancel request

const cancelRequest = async (recipientId) => {
    try {
        await router.post('/user/cancel-request', {
            recipient_id: recipientId
        }, {
            preserveScroll: true,
            onSuccess: () => {
                ElNotification({
                    title: 'Canceled',
                    message: 'Connection request canceled.',
                    type: 'info',
                    duration: 3000,
                });
                requestSent.value = false;
                requestReceived.value = false;
                connected.value = false;
            }
        });
    } catch (error) {
        ElNotification({
            title: 'Error',
            message: 'Failed to cancel request.',
            type: 'error',
            duration: 3000,
        });
    }
}
const acceptRequest = async (senderId) => {
    try {
        await router.post('/user/accept-request', {
            sender_id: senderId
        }, {
            preserveScroll: true,
            onSuccess: () => {
                const message = page.props.flash?.message || 'Connection request accepted.';
                ElNotification({
                    title: 'Accepted',
                    message,
                    type: 'success',
                    duration: 3000,
                });

                requestReceived.value = false;
                connected.value = true;
            }
        });
    } catch (error) {
        ElNotification({
            title: 'Error',
            message: 'Failed to accept connection request.',
            type: 'error',
            duration: 3000,
        });
    }
};

// Disconnect
const disconnect = async (connectID) => {
    try {
        await router.post('/user/disconnect-request', {
            connectID: connectID
        }, {
            preserveScroll: true,
            onSuccess: () => {
                ElNotification({
                    title: 'Disconnected',
                    message: 'You are no longer connected.',
                    type: 'warning',
                    duration: 3000,
                });
                connected.value = false;
            }
        });
    } catch (error) {
        ElNotification({
            title: 'Error',
            message: 'Failed to disconnect.',
            type: 'error',
            duration: 3000,
        });
    }
};

</script>
<template>
    <MainWrapper>
        <div class="min-h-screen bg-gradient-to-b from-pink-100 to-white p-6">
            <div class="from-pink-100 to-white text-gray-800">
                <!-- Profile Card -->
                <div class="max-w-6xl mx-auto rounded-lg overflow-hidden flex flex-col md:flex-row md:space-x-6 p-4">
                    <!-- Profile Image -->
                    <div class="md:w-1/3 flex mb-6 md:mb-0">
                        <img :src="viewProfile.image_url" alt="Profile" class="rounded-lg w-full h-1/4 max-w-xs" />
                    </div>

                    <!-- Profile Details -->
                    <div class="md:w-2/3 space-y-6">
                        <div class="bg-rose-500 text-white rounded-lg p-4 relative">
                            <h2 class="text-2xl font-bold flex items-center gap-3">
                                {{ viewProfile.name }}
                            </h2>
                            <p class="mt-1 italic">
                                {{ viewProfile.bio }}
                            </p>
                            <div class="mt-4 space-y-1">
                                <p>Age: <span class="font-semibold"> {{ viewProfile.age }} yr</span></p>
                                <p>Marital Status: <span class="font-semibold">{{ viewProfile.marrital_status }}</span>
                                </p>
                                <p>Religion: <span class="font-semibold">{{ viewProfile.religion }}</span></p>
                                <p>Address: <span class="font-semibold">{{ viewProfile.location }}</span></p>
                            </div>
                            <!-- If request is not sent -->
                            <!-- Connected -->
                            <div class="absolute top-4 right-4 space-x-2">
                                <!-- Connected -->

                                <template v-if="connected">
                                    <Link :href="route('user.messages.view', viewProfile.user.id)"
                                        class="bg-white text-rose-500 border border-white rounded-full px-4 py-2 font-semibold hover:bg-rose-100"
                                        disabled>
                                        💬 Send Message
                                    </Link>
                                    <button @click="disconnect(connection.id)"
                                        class="bg-white text-rose-500 border border-white rounded-full px-4 py-1 font-semibold hover:bg-rose-100">
                                        ❌ Disconnect
                                    </button>
                                </template>
                                <!-- Request Received -->
                                <template v-else-if="requestReceived">
                                    <button @click="acceptRequest(viewProfile.id)"
                                        class=" bg-white text-rose-500 border border-white rounded-full px-4 py-1 font-semibold hover:bg-rose-100">
                                        ✅ Accept
                                    </button>
                                    <button @click="cancelRequest(viewProfile.id)"
                                        class=" bg-white text-rose-500 border border-white rounded-full px-4 py-1 font-semibold hover:bg-rose-100">
                                        ❌ Cancel
                                    </button>
                                </template>

                                <!-- Request Sent -->
                                <button v-else-if="requestSent" @click="cancelRequest(viewProfile.id)"
                                    class=" bg-white text-rose-500 border border-white rounded-full px-4 py-1 font-semibold hover:bg-rose-100">
                                    ❌ Cancel Request
                                </button>
                                <!-- No Connection Yet -->
                                <button v-else @click="sendRequest(viewProfile.id)"
                                    class=" bg-white text-rose-500 border border-white rounded-full px-4 py-1 font-semibold hover:bg-rose-100">
                                    👥 Send Request
                                </button>

                            </div>


                        </div>

                        <!-- Intro -->
                        <section>
                            <h2
                                class="text-xl font-bold text-rose-500 border-b border-rose-300 p-4 flex items-center gap-2">
                                {{ viewProfile.name }} Intro 📑
                            </h2>
                            <p class="text-sm mt-2">
                                {{ viewProfile.bio }}
                            </p>
                        </section>

                        <!-- Personal Information -->
                        <section>
                            <h3 class="text-lg font-bold text-rose-500 mb-2">Personal Information :</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div class="bg-blue-100 px-3 py-2 rounded">Nationality: <strong>{{
                                    viewProfile.natinality
                                        }}</strong></div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Birth Place: <strong>{{
                                    viewProfile.birth_place }}</strong></div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Height: <strong>{{ viewProfile.height }}
                                        Inch</strong></div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Weight: <strong>{{ viewProfile.height }}
                                        Kg</strong></div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Body Type: <strong>{{ viewProfile.body_type
                                }}</strong></div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Complexion: <strong>{{ viewProfile.complexion
                                }}</strong></div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Blood Group: <strong>{{
                                    viewProfile.blood_group
                                        }}</strong></div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Family Status:
                                    <strong>{{ viewProfile.family_status }}</strong>
                                </div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Living With Family?
                                    <strong>{{ viewProfile.living_with_family }}</strong>
                                </div>
                            </div>
                        </section>

                        <!-- Education -->
                        <section>
                            <h3 class="border-t border-rose-300 text-lg font-bold text-rose-500 mb-2">Education :</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div class="bg-blue-100 px-3 py-2 rounded">Highest Educational:
                                    <strong>{{ viewProfile.education_level }}</strong>
                                </div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Education Institute:
                                    <strong>{{ viewProfile.institute_name }}</strong>
                                </div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Passing Year:
                                    <strong>{{ viewProfile.education_year }}</strong>
                                </div>
                            </div>
                        </section>

                        <!-- Work -->
                        <section>
                            <h3 class="border-t border-rose-300  text-lg font-bold text-rose-500 mb-2">Work :</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div class="bg-blue-100 px-3 py-2 rounded">Profession: <strong>{{ viewProfile.profession
                                }}</strong>
                                </div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Designation: <strong>{{
                                    viewProfile.designation
                                        }}</strong></div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Your Income (Monthly): <strong>
                                        {{ viewProfile.monthly_income }} BDT</strong></div>
                            </div>
                        </section>

                        <!-- Contact -->
                        <section>
                            <h3
                                class=" text-xl font-bold text-rose-500 border-t border-rose-300 pt-4 flex items-center gap-2">
                                Contact Details 📞
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                <div class="bg-blue-100 px-3 py-2 rounded">Email: </div>
                                <div class="bg-blue-100 px-3 py-2 rounded">Contact Number:
                                    <strong>{{ viewProfile.user.number }}</strong>
                                </div>
                            </div>
                        </section>

                        <!-- Hobbies -->
                        <section>
                            <h3
                                class="text-xl font-bold text-rose-500 border-t border-rose-300 pt-4 flex items-center gap-2">
                                Hobbies 🎨 :{{ viewProfile.hobby }}
                            </h3>
                            <div class="flex flex-wrap gap-4 mt-4">
                                <div class="bg-blue-100 text-blue-800 px-4 py-1 rounded-full flex items-center gap-2">
                                    🧍 Drinking: <strong>{{ viewProfile.drinking }}</strong>
                                </div>
                                <div class="bg-blue-100 text-blue-800 px-4 py-1 rounded-full flex items-center gap-2">
                                    🚬 Smoking: <strong>{{ viewProfile.smoking }}</strong>
                                </div>
                            </div>
                        </section>
                        <!-- Match Preferences Section -->

                        <section class="border-t border-rose-300 pt-6">
                            <h2 class="text-xl font-bold text-rose-500 mb-6 flex items-center gap-2">
                                What is She Looking For ! 💋
                            </h2>

                            <!-- Match Images -->
                            <div class="flex flex-col sm:flex-row justify-between items-center text-center gap-6">
                                <div>
                                    <img :src="viewProfile.image_url"
                                        class="w-24 h-24 rounded-full border-4 border-rose-300 mx-auto" />
                                    <p class="mt-2 text-gray-600">Her Preference</p>
                                </div>

                                <div>
                                    <hr class="border-dashed border-t border-gray-400 w-64 mx-auto" />
                                    <p
                                        class="mt-2 inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">
                                        Total Matches: {{ matchedCount }} out of {{ totalFields }}
                                    </p>
                                </div>

                                <div>
                                    <img :src="authProfile.image_url"
                                        class="w-24 h-24 rounded-full border-4 border-rose-300 mx-auto" />
                                    <p class="mt-2 text-gray-600">Your Match</p>
                                </div>
                            </div>

                            <!-- Match Comparison Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-y-4 mt-8">
                                <div class="text-right sm:pr-2 text-rose-500 font-semibold">Religion :</div>
                                <div class="col-span-2 flex justify-between border-b border-rose-200 pb-1">
                                    <span class="text-gray-700">{{ vMatch.religion }}</span>
                                    <span :class="isReligionMatch ? 'text-green-500' : 'text-red-500'">
                                        <i :class="isReligionMatch ? 'fas fa-check' : 'fas fa-times'"></i>
                                    </span>
                                </div>

                                <div class="text-right sm:pr-2 text-rose-500 font-semibold">Marital Status :</div>
                                <div class="col-span-2 flex justify-between border-b border-rose-200 pb-1">
                                    <span class="text-gray-700">{{ vMatch.marital_status }}</span>
                                    <span :class="isMaritalStatusMatch ? 'text-green-500' : 'text-red-500'">
                                        <i :class="isMaritalStatusMatch ? 'fas fa-check' : 'fas fa-times'"></i>
                                    </span>
                                </div>

                                <div class="text-right sm:pr-2 text-rose-500 font-semibold">Age :</div>
                                <div class="col-span-2 flex justify-between border-b border-rose-200 pb-1">
                                    <span class="text-gray-700">{{ vMatch.from_age }} to {{ vMatch.to_age }}
                                        yr</span>
                                    <span :class="isAgeMatch ? 'text-green-500' : 'text-red-500'">
                                        <i :class="isAgeMatch ? 'fas fa-check' : 'fas fa-times'"></i>
                                    </span>
                                </div>

                                <div class="text-right sm:pr-2 text-rose-500 font-semibold">Education :</div>
                                <div class="col-span-2 flex justify-between border-b border-rose-200 pb-1">
                                    <span class="text-gray-700">{{ vMatch.education }}</span>
                                    <span :class="isEducationMatch ? 'text-green-500' : 'text-red-500'">
                                        <i :class="isEducationMatch ? 'fas fa-check' : 'fas fa-times'"></i>
                                    </span>
                                </div>

                                <div class="text-right sm:pr-2 text-rose-500 font-semibold">Location :</div>
                                <div class="col-span-2 flex justify-between border-b border-rose-200 pb-1">
                                    <span class="text-gray-700">{{ vMatch.location }}</span>
                                    <span :class="isLocationMatch ? 'text-green-500' : 'text-red-500'">
                                        <i :class="isLocationMatch ? 'fas fa-check' : 'fas fa-times'"></i>
                                    </span>
                                </div>

                                <div class="text-right sm:pr-2 text-rose-500 font-semibold">Height :</div>
                                <div class="col-span-2 flex justify-between border-b border-rose-200 pb-1">
                                    <span class="text-gray-700">{{ vMatch.height_from }} Inch to {{ vMatch.height_to
                                    }} Inch</span>
                                    <span :class="isHeightMatch ? 'text-green-500' : 'text-red-500'">
                                        <i :class="isHeightMatch ? 'fas fa-check' : 'fas fa-times'"></i>
                                    </span>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>



    </MainWrapper>
</template>