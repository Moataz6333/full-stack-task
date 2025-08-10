<script setup>
import Navbar from "@/components/Navbar.vue";
import {
  Users,
  ClipboardCheck,
  Calendar,
  BarChart3,
  Bell,
  MessageCircle,
  User2,
  Github,
  Linkedin,
} from "lucide-vue-next";
</script>

<template>
  <Navbar />
  <div
    class="min-h-screen w-full bg-gradient-to-br from-gray-950 via-blue-950 to-gray-900 text-white flex flex-col">
    <!-- Hero Section -->
    <section
      class="flex flex-col items-center justify-center flex-1 py-20 animate-fade-in">
      <h1
        class="text-5xl md:text-7xl font-extrabold mb-4 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent drop-shadow-lg animate-gradient-x">
        Full-Stack task
      </h1>
     
      
    </section>

   

    <!-- Footer Section -->
    <footer
      id="contact"
      class="mt-auto py-8 bg-gradient-to-r from-gray-950 via-blue-950 to-gray-950 text-center animate-fade-in border-t border-gray-800">
      <div class="flex justify-center gap-6 mb-2">
        <a
          href="https://github.com/Moataz6333"
          target="_blank"
          class="hover:text-blue-400 transition"
          ><Github size="28"
        /></a>
        <a
          href="https://www.linkedin.com/in/moataz-ahmed-b18a49276?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"
          target="_blank"
          class="hover:text-blue-400 transition"
          ><Linkedin size="28"
        /></a>
      </div>
      <p class="text-gray-400">&copy; 2025 Full-Stack task. All rights reserved.</p>
    </footer>
  </div>
</template>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
.animate-fade-in {
  animation: fade-in 1s ease;
}
@keyframes fade-in-up {
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.animate-fade-in-up {
  animation: fade-in-up 1.2s cubic-bezier(0.4, 0, 0.2, 1);
}
@keyframes gradient-x {
  0%,
  100% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
}
.animate-gradient-x {
  background-size: 200% 200%;
  animation: gradient-x 4s ease-in-out infinite;
}
</style>
