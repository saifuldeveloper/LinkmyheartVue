<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import MainWrapper from './MainWrapper.vue';
const page = usePage();
const chatId = computed(() => page.props.chatId ?? null);
const chatUrl = computed(() => chatId.value ? `/chatify/${chatId.value}` : `/chatify`);

</script>

<template>
  <MainWrapper>
    <div class="py-5 px-5">
      <iframe 
        :src="chatUrl" 
        class="w-full h-[80vh] border rounded" 
        frameborder="0" 
        allowfullscreen
      ></iframe>
    </div>
  </MainWrapper>
</template>