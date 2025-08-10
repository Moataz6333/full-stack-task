<script setup>
import { RouterLink } from 'vue-router';
import Navbar from '@/components/Navbar.vue';
defineProps({
    title: {
        type: String,
        default: 'Welcome to Our Application'
    }
});

</script>

<template>
    <Navbar />
    <div class="flex min-h-[70vh] flex-col items-center justify-center gap-6 bg-background p-6 md:p-10 text-white">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col items-center gap-4">
                    <RouterLink to="/" class="flex flex-col items-center gap-2 font-medium">
                        
                        <span class="sr-only">{{ title }}</span>
                    </RouterLink>
                    <div class="space-y-2 text-center">
                        <h1 class="text-xl font-medium">{{ title }}</h1>
                       
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
