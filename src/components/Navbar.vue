<script setup>
import { RouterLink ,useRoute} from 'vue-router';


const isActiveLink=(routePath)=>{
  const route=useRoute();
  return route.path=== routePath;
}

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
                <RouterLink
                  to="/"
                  :class="[
                    isActiveLink('/') ? 'bg-gray-700' : 'hover:bg-gray-600 hover:text-white',
                    'text-white', 'rounded-md', 'px-3', 'py-2']"
                  >Home</RouterLink
                >
                <RouterLink
                  to="/admin/login"
                  :class="[
                    isActiveLink('/admin/login') ? 'bg-gray-700' : 'hover:bg-gray-600 hover:text-white',
                    'text-white', 'rounded-md', 'px-3', 'py-2']"
                  >Admin</RouterLink
                >
                <RouterLink
                  to="/user/login"
                  :class="[
                    isActiveLink('/user/login') ? 'bg-gray-700' : 'hover:bg-gray-600 hover:text-white',
                    'text-white', 'rounded-md', 'px-3', 'py-2']"
                  >User</RouterLink
                >
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
</template>