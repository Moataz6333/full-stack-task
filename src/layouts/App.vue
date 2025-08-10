<script setup>
import profile from "@/assets/profile.jfif";
import { RouterLink, useRoute, useRouter } from "vue-router";
import { useToast } from "vue-toastification";
import AuthNavBar from "@/components/AuthNavBar.vue";
import { ref,onMounted } from "vue";
const name=localStorage.getItem('name');
const email=localStorage.getItem('email');
const toast = useToast();





</script>

<template>
  <div class="w-full  text-white">
    <AuthNavBar />
    <!-- main content -->
    <div class="w-full p-3  max-sm:p-2.5  ">
      <slot></slot>
    </div>
  </div>
</template>
