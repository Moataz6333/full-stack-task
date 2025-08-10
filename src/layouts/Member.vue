<script setup>
import logo from "@/assets/logo.png";
import profile from "@/assets/profile.jfif";
import { RouterLink, useRoute,useRouter } from "vue-router";
import { Users, Projector , NotepadText ,LayoutGrid ,ClipboardCheck,BellDot} from "lucide-vue-next";
import { onMounted ,ref } from "vue";
import { serverUrl } from "@/config.js";
import PulseLoader from "vue-spinner/src/PulseLoader.vue";
import api from "@/axios";
import { useToast } from "vue-toastification";
const toast = useToast();
const name=localStorage.getItem('name');
const email=localStorage.getItem('email');
const userProfile=localStorage.getItem('profile');
const router=useRouter();
const isLoading=ref(true);
const isActiveLink = (routePath,arr=[]) => {
  const route = useRoute();
  return route.path === routePath || arr.includes(route.path.split('/')[1]) ;
};

</script>

<template>
  
  <div   class="w-full flex gap-2.5 max-sm:gap-1 text-white">
    <!-- sidebar -->
    <div
      class="w-[25vw] max-sm:w-[15vw] bg-gray-950 h-screen rounded-r-xl rounded-b-xl p-3 flex flex-col justify-between">
      <div class="w-full">
        <RouterLink to="/dashboard">
          <div
            class="flex gap-4 justify-start max-sm:justify-center pb-6 p-3 max-sm:p-0 max-sm:py-3 items-center border-t-1 rounded-lg border-t-gray-300">
            <img
              :src="logo"
              alt="Logo"
              class="size-6 fill-current text-[var(--foreground)] dark:text-white" />
            <h2 class="text-lg font-medium max-sm:hidden">Team Link</h2>
          </div>
        </RouterLink>
        <hr class="text-gray-500" />
        <!-- ul -->
        <div
          class="mt-4 px-4 w-full flex max-sm:justify-center max-sm:items-center flex-col gap-3 max-sm:p-0">
          <RouterLink
          to="/m/dashboard"
            :class="{
              'text-white border-t-2 bg-gray-700': isActiveLink('/m/dashboard'),
            }"
            class="text-gray-400 w-full text-md p-2 max-sm:p-1.5 max-sm:w-fit hover:bg-gray-700 hover:text-white hover:border-t-2 hover:border-t-white transition-normal duration-300 rounded-lg flex items-center gap-1.5">
            <LayoutGrid size="18px" class="mr-2.5 max-sm:m-0" /><span
              class="max-sm:hidden">
              Dashboard</span
            >
          </RouterLink>
          <RouterLink
          to="/m/team"
            :class="{
              'text-white border-t-2 bg-gray-700': isActiveLink('/m/team'),
            }"
            class="text-gray-400 w-full text-md p-2 max-sm:p-1.5 max-sm:w-fit hover:bg-gray-700 hover:text-white hover:border-t-2 hover:border-t-white transition-normal duration-300 rounded-lg flex items-center gap-2">
            <Users size="18px" class="mr-2.5 max-sm:m-0" />
            <span class="max-sm:hidden"> Team</span>
          </RouterLink>
          
          <RouterLink
          to="/m/tasks"
            :class="{
              'text-white border-t-2 bg-gray-700': isActiveLink('/m/tasks',['mytask']),
            }"
            class="text-gray-400 w-full text-md p-2 max-sm:p-1.5 max-sm:w-fit hover:bg-gray-700 hover:text-white hover:border-t-2 hover:border-t-white transition-normal duration-300 rounded-lg flex items-center gap-2">
            <ClipboardCheck size="18px" class="mr-2.5 max-sm:m-0" />
            <span class="max-sm:hidden"> Tasks</span>
          </RouterLink>
          <RouterLink
          to="/m/notes"
            :class="{
              'text-white border-t-2 bg-gray-700': isActiveLink('/m/notes'),
            }"
            class="text-gray-400 w-full text-md p-2 max-sm:p-1.5 max-sm:w-fit hover:bg-gray-700 hover:text-white hover:border-t-2 hover:border-t-white transition-normal duration-300 rounded-lg flex items-center gap-2">
            <NotepadText size="18px" class="mr-2.5 max-sm:m-0" />
            <span class="max-sm:hidden"> Notes</span>
          </RouterLink>
          <RouterLink
          to="/m/notifications"
            :class="{
              'text-white border-t-2 bg-gray-700': isActiveLink('/m/notifications'),
            }"
            class="text-gray-400 w-full text-md p-2 max-sm:p-1.5 max-sm:w-fit hover:bg-gray-700 hover:text-white hover:border-t-2 hover:border-t-white transition-normal duration-300 rounded-lg flex items-center gap-2">
            <BellDot size="18px" class="mr-2.5 max-sm:m-0" />
            <span class="max-sm:hidden"> Notifications</span>
          </RouterLink>
        </div>
      </div>
      <!-- footer -->
      <RouterLink to="/m/profile">
        <div
          class="flex gap-4 justify-start p-3 overflow-hidden max-sm:p-0 max-sm:py-3 max-sm:border-b-0 max-sm:justify-cneter items-center border-b-1 rounded-lg border-b-gray-300">
          <img
            :src="userProfile? userProfile :profile"
            alt="profile"
            class="w-8 h-8 object-cover rounded-full fill-current text-[var(--foreground)] dark:text-white" />
          <div class="max-sm:hidden">
            <h2 class="text-md font-medium">{{name}}</h2>
            <p class="text-sm text-gray-600">{{ email }}</p>
          </div>
        </div>
      </RouterLink>
    </div>
    <!-- main content -->
     <div class="w-full p-4 max-sm:p-2.5 max-h-screen overflow-y-scroll">
       <slot></slot>
     </div>
  </div>
</template>
