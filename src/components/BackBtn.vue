<script setup>
import { RouterLink } from "vue-router";
import { MoveLeft } from "lucide-vue-next";
defineProps({
  url: { String, default: "/" },
});
</script>
<template>
  <section>
    <div class="mr-3">
      <RouterLink
        :to="url"
        class="flex h-fit w-fit justify-center items-center bg-gray-900 text-white text-lg rounded-lg p-1.5 cursor-pointer hover:bg-gray-950">
        <MoveLeft />
      </RouterLink>
    </div>
  </section>
</template>
