<script setup>
import { LogOut, Loader } from "lucide-vue-next";
import { RouterLink, useRoute, useRouter } from "vue-router";

const router = useRouter();

const logout = () => {
  localStorage.removeItem("token");
  localStorage.removeItem("name");
  localStorage.removeItem("email");
  localStorage.removeItem("role");
  router.push("/");
};
</script>
<template>
  <nav class="bg-gray-900 border-b border-gray-500">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="flex h-20 items-center justify-between">
        <div
          class="flex flex-1 items-center justify-center md:items-stretch md:justify-start">
          <!-- Logo -->
          <RouterLink class="flex flex-shrink-0 items-center mr-4" to="/">
            <span class="hidden md:block text-white text-2xl font-bold ml-2"
              >My Project</span
            >
          </RouterLink>
          <div class="md:ml-auto">
            <div class="flex space-x-2">
              <button
                @click="logout"
                class="flex h-fit justify-center items-center bg-gray-700 text-white text-lg rounded-lg p-2.5 cursor-pointer hover:bg-gray-950 transition-colors">
                Log-out <LogOut class="ml-2" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>
