<script setup>
import { RouterLink } from "vue-router";
import Navbar from "@/components/Navbar.vue";
</script>
<template>
  <Navbar/>
  <section class="text-center flex flex-col justify-center items-center h-96">
    <h1 class="text-2xl font-bold mb-4">404 Not Found</h1>
    <p class="text-xl mb-5">This page does not exist</p>
    <RouterLink
      to="/"
      class="text-white bg-gray-700 hover:bg-gray-900 rounded-md px-3 py-2 mt-4"
      >Go Back</RouterLink
    >
  </section>
</template>
