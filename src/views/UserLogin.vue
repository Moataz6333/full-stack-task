<script setup>
import Auth from "@/layouts/Auth.vue";
import { serverUrl } from "@/config.js";
import InputError from "@/components/InputError.vue";
import { reactive, ref } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";
import { Loader } from "lucide-vue-next";
import { useRouter } from "vue-router";

const router=useRouter();
const toast = useToast();
const isLoading = ref(false);
const form = reactive({
  name: "",
  email: "",
  password: "",
  remember: "",
});
const init = { ...form };

const formErrors = reactive({
  name: [],
  email: [],
  password: [],
  remember: [],
});
const initErr = { ...formErrors };

const submitForm = async () => {
  isLoading.value = true;
  try {
    const response = await axios.post(`${serverUrl}/user/login`, form);
  
    isLoading.value = false;
     localStorage.setItem("token", response.data.token);
    localStorage.setItem("name", response.data.user.name);
    localStorage.setItem("email", response.data.user.email);
    localStorage.setItem("role", response.data.user.role);
       router.push("/user/dashboard");

    toast.success("Login successful!");

    // reset
    Object.assign(form, init);
    Object.assign(formErrors, initErr);
  } catch (error) {
    toast.error("Something went wrong!");
    console.log(error);
    Object.assign(formErrors, initErr);
    isLoading.value = false;
    formErrors.name = error.response.data.errors.name;
    formErrors.email = error.response.data.errors.email;
    formErrors.remember = error.response.data.errors.remember;

    console.log(formErrors);
  }
};
</script>
<template>
  <Auth title="User Login">
    <form @submit.prevent="submitForm">
      <div class="w-full h-full my-3">
        <div class="w-full my-3">
          <label for="email" class="text-xl">Email</label>
          <InputError :messages="formErrors.email" />
          <input
            v-model="form.email"
            id="email"
            name="email"
            type="email"
            required
            placeholder="Email@example.com"
            class="mt-2.5 block w-full bg-gray-600 rounded-lg border-0 py-3.5 pl-5 text-xl max-sm:py-2 text-white ring-1 ring-gray-200 ring-inset placeholder:text-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-inset sm:text-lg" />
        </div>
        <div class="w-full my-3">
          <label for="password" class="text-xl">Password</label>
          <InputError :messages="formErrors.password" />
          <input
            v-model="form.password"
            id="password"
            name="password"
            type="password"
            placeholder="password"
            required
            class="mt-2.5 block w-full bg-gray-600 rounded-lg border-0 py-3.5 pl-5 text-xl max-sm:py-2 text-white ring-1 ring-gray-200 ring-inset placeholder:text-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-inset sm:text-lg" />
        </div>
        <div class="w-full my-3 flex gap-3 items-center">
          <input
            v-model="form.remember"
            id="remember"
            name="remember"
            type="checkbox" />
          <label for="remember" class="text-sm text-gray-500"
            >Remember me</label
          >
        </div>
        <div class="w-full my-3">
          <button
            :disabled="isLoading"
            :class="[isLoading ? 'cursor-no-drop' : 'cursor-pointer']"
            type="submit"
            class="w-full h-full flex justify-center items-center bg-blue-600 text-white text-xl font-semibold rounded-lg p-4 cursor-pointer hover:bg-blue-800">
            Submit <Loader v-if="isLoading" class="ml-2 animate-spin" />
          </button>
        </div>
      </div>
    </form>
  </Auth>
</template>
