<script setup>
import { ref, reactive, onMounted, nextTick, computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';

const user = computed(() => usePage().props.auth?.user)
const isOpen = ref(false);
const showRegister = ref(false)
const step = ref(1)
const showModal = ref(true)
const form = reactive({
  name: '',
  gender: '',
  phone: '',
  password: '',
  password_confirmation: '',
})


const otp = reactive(['', '', '', '', '', '']) // 6-digit OTP

const otpDigits = Array(6).fill(0)
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


const OtpVerify = async () => {
  try {
    const res = await fetch('/register-otp', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify({
        name: form.name,
        gender: form.gender,
        phone: form.phone,
      }),
    });

    const data = await res.json();

    if (res.ok && data.success) {
      step.value = 2; // move to OTP step
    } else {
      alert(data.message || 'Failed to send OTP');
    }
  } catch (error) {
    alert('Error sending OTP');
    console.error(error);
  }
};



// Refs for OTP input fields code start
const otpRefs = ref([])
function moveNext(i, e) {
  if (e.target.value && i < 5) otpRefs.value[i + 1]?.focus()
}
function movePrev(i, e) {
  if (!otp[i] && i > 0) otpRefs.value[i - 1]?.focus()
}

onMounted(() => nextTick(() => otpRefs.value[0]?.focus()))

// Refs for OTP input fields code end




const submitOtp = async () => {
  const otpValue = otp.join('');
  if (otpValue.length < 6) {
    alert('Please enter a valid 6-digit OTP');
    return;
  }

  try {
    const res = await fetch('/register-otp-verify', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify({
        phone: form.phone,
        otp: otpValue,
      }),
    });


    const data = await res.json();

    if (res.ok) {
      step.value = 3;


    } else {
      alert(data.error || 'Failed to send OTP');
    }



  } catch (err) {
    alert('Error verifying OTP');
    console.error(err);
  }
}


// register- user 
const registerUser = async () => {
  if (form.password.length < 6) {
    alert('Password must be at least 6 characters')
    return
  }

  if (form.password !== form.password_confirmation) {
    alert('Passwords do not match')
    return
  }

  try {
    const res = await fetch('/registration', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify(form),
    })

    const data = await res.json()

    if (res.ok && data.success) {
      showModal.value = false
      router.visit(data.redirect)
    } else {
      alert(data.message || 'Registration failed')
    }

  } catch (err) {
    alert('Error completing registration')
    console.error(err)
  }
}


function resetForm() {
  showRegister.value = false
  step.value = 1
  form.value = {
    name: '',
    email: '',
    phone: '',
    password: '',
  }
  otp.value = ['', '', '', '', '', '']
}

const showAuthMenu = ref(false);

// home page nav deisng 
const page = usePage()
const isHomePage = page.url === '/'

</script>

<template>
  <div class="container px-4 lg:px-10 mx-auto">
    <nav class="flex items-center justify-between p-6 relative">
      <!-- Logo -->
      <Link href="/" class="font-bold text-xl flex items-center">
      <img src="https://linkmyheart.com/frontend-assets/imgs/logo.png" alt="Logo" class="w-36" />
      </Link>

      <!-- Mobile Menu Toggle -->
      <button @click="isOpen = !isOpen" class="lg:hidden text-gray-700 focus:outline-none">
        <svg v-if="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

      <!-- Navigation Links -->
      <ul :class="[
        'lg:flex items-center text-center absolute lg:static bg-white w-full left-0 top-full z-50 shadow lg:shadow-none lg:w-auto lg:bg-transparent',
        isOpen ? 'block' : 'hidden'
      ]">
        <li>
          <Link :href="route('home')" class="block px-4 py-2 hover:text-red-600">Home</Link>
        </li>
        <li>
          <Link :href="route('about')" class="block px-4 py-2 hover:text-red-600">About Us</Link>
        </li>
        <li>
          <Link :href="route('pricing')" class="block px-4 py-2 hover:text-red-600">Pricing</Link>
        </li>
        <li>
          <Link :href="route('faq')" class="block px-4 py-2 hover:text-red-600">FAQ</Link>
        </li>
        <li>
          <Link :href="route('support')" class="block px-4 py-2 hover:text-red-600">Support</Link>
        </li>
        <li class="lg:hidden">
          <Link href="/loginsection" class="block px-4 py-2 hover:text-red-600">Login</Link>
        </li>
      </ul>



      <!-- User Auth Controls -->
      <div class="relative hidden lg:inline-block">
        <!-- If user is logged in -->
        <template v-if="user">
          <!-- Dashboard Button -->
          <button @click="showAuthMenu = !showAuthMenu"
            class="px-5 py-3 text-sm text-[#d91414de] bg-[#fbf7f791] border-2 border-[#c64b64] rounded-[12px] transition duration-200">
            Dashboard
          </button>

          <!-- User Dropdown Menu -->
          <div v-if="showAuthMenu"
            class="absolute top-full left-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
            <ul class="text-sm text-gray-700">
              <li>
                <Link :href="route('partner.preference')" class="block px-4 py-2 hover:bg-gray-100">Dashboard</Link>
              </li>
               <li>
                <Link :href="route('user.matches')" class="block px-4 py-2 hover:bg-gray-100">Matches</Link>
              </li>
               <li>
                <Link :href="route('user.messages')"  class="block px-4 py-2 hover:bg-gray-100">Messages</Link>
              </li>
               <li>
                <Link :href="route('profile.edit')"  class="block px-4 py-2 hover:bg-gray-100">Profile</Link>
              </li>
              <li>
                <Link :href="route('verify.account')" class="block px-4 py-2 hover:bg-gray-100">Verification</Link>
              </li>
              <li>
                <Link :href="route('user.profile.contact')" class="block px-4 py-2 hover:bg-gray-100">Profile Contact</Link>
              </li>
              <li>
                <Link :href="route('partner.preference')" class="block px-4 py-2 hover:bg-gray-100">  Partner Preference  </Link>
              </li>
              <li>
                <Link method="POST"  :href="route('logout.user')" class="block px-4 py-2 hover:bg-gray-100">  <i class="fas fa-sign-out-alt w-5"></i>Logout</Link>
              </li>
            </ul>
          </div>
        </template>

        <!-- If not logged in -->
        <template v-else>
          <div class="d-flex space-x-2">
            <button class="px-5 py-3 text-lg" @click="router.visit('/login')">
              Login
            </button>
            <button @click="showRegister = true"
              class="px-5 py-3 text-sm text-[#d91414de] bg-[#fbf7f791] border-2 border-[#c64b64] rounded-[12px] transition duration-200">
              Join Now
            </button>
          </div>
        </template>
      </div>
      <!-- Right Side: Auth Buttons or Dashboard -->






      <!-- Registration Modal -->
      <div v-if="showRegister" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-2xl rounded-xl p-6 shadow-xl relative">
          <button @click="resetForm"
            class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-xl">&times;</button>

          <h2 class="text-2xl font-semibold text-center text-red-600 mb-6">
            {{ step === 1 ? 'Create Account' : step === 2 ? 'Verify OTP' : 'Set Password' }}
          </h2>

          <!-- Step 1: Registration -->
          <form v-if="step === 1" @submit.prevent="OtpVerify" class="space-y-4">
            <div class="flex gap-4">
              <div class="w-1/2">
                <label class="block mb-1 text-sm text-gray-700">Full Name</label>
                <input v-model="form.name" type="text"
                  class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400"
                  placeholder="Enter your full name" required />
              </div>
              <div class="w-1/2">
                <label class="block mb-1 text-sm text-gray-700">Gender</label>
                <select v-model="form.gender"
                  class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-pink-400"
                  required>
                  <option value="" disabled selected>Select gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>
            <div>
              <label class="block mb-1 text-sm text-gray-700">Phone Number</label>
              <input v-model="form.phone" type="text"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                placeholder="Enter your phone" required />
            </div>
            <button type="submit"
              class="w-full bg-gradient-to-r from-[#f50536bf] to-[#260000b8] text-white font-semibold py-3 rounded-md">
              Continue
            </button>
          </form>

          <!-- Step 2: OTP Verification -->
          <form v-else-if="step === 2" @submit.prevent="submitOtp" class="space-y-4">
            <p class="text-sm text-gray-600 text-center mb-2">
              We’ve sent an OTP to <strong>{{ form.phone }}</strong>
            </p>
            <div class="text-center gap-5 px-15">
              <input v-for="(digit, i) in 6" :key="i" v-model="otp[i]" ref="otpRefs" maxlength="1" type="text"
                class="w-12 h-12 mx-1 text-center border rounded" @input="e => moveNext(i, e)"
                @keydown.backspace="e => movePrev(i, e)" />
            </div>
            <button type="submit"
              class="w-full bg-gradient-to-r from-[#f50536bf] to-[#260000b8] text-white font-semibold py-3 rounded-md">
              Verify OTP
            </button>
            <p class="text-sm text-center text-gray-600 mt-3">
              Didn’t receive code?
              <button type="button" class="text-red-600 hover:underline ml-1">Resend</button>
            </p>
          </form>

          <!-- Step 3: Set Password -->
          <form v-else-if="step === 3" @submit.prevent="registerUser" class="space-y-4">
            <div>
              <label class="block mb-1 text-sm text-gray-700">Password</label>
              <input v-model="form.password" type="password"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                placeholder="Enter your password" required />
            </div>
            <div>
              <label class="block mb-1 text-sm text-gray-700">Confirm Password</label>
              <input v-model="form.password_confirmation" type="password"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                placeholder="Confirm your password" required />
            </div>
            <button type="submit"
              class="w-full bg-gradient-to-r from-[#f50536bf] to-[#260000b8] text-white font-semibold py-3 rounded-md">
              Complete Registration
            </button>
          </form>
        </div>
      </div>
    </nav>
  </div>
  <hr v-if="!isHomePage" class="top-Header-bottom-border" />
</template>

<style scoped>
.position-relative {
  position: relative;
}

.top-Header-bottom-border {
  margin: 0;
  height: 3px;
  background: linear-gradient(90deg,
      rgba(252, 202, 213, 0) 0%,
      rgba(244, 54, 98, 1) 50%,
      rgba(255, 255, 255, 0) 100%);
  width: 100%;
  border: none;
}
</style>
