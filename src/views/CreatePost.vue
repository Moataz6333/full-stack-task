<script setup>
import App from "@/layouts/App.vue";
import BackBtn from "@/components/BackBtn.vue";
import { ref } from "vue";
import InputError from "@/components/InputError.vue";
import { Loader } from "lucide-vue-next";
import { useToast } from "vue-toastification";
import api from "@/axios";
import { serverUrl } from "@/config";

const createForm = ref({
  title: "",
  content: "",
  status: "published",
});
const createFormErrors = ref({
  title: [],
  content: [],
  status: [],
});

const CreateLoader = ref(false);
const toast = useToast();
async function submitCreatePost() {
  createFormErrors.value = { title: [], content: [], status: [] };
  CreateLoader.value = true;
  try {
    const response = await api.post(
      `${serverUrl}/create-post`,
      createForm.value
    );
    if (response.status === 201) {
      toast.success("Post created successfully");
      createForm.value = { title: "", content: "", status: "published" };
      
    } else {
      toast.error("Failed to create post");
    }
  } catch (error) {
    console.log(error);
    if (error.response && error.response.data && error.response.data.errors) {
      createFormErrors.value.title = error.response.data.errors.title || [];
      createFormErrors.value.content = error.response.data.errors.content || [];
      createFormErrors.value.status = error.response.data.errors.status || [];
    }
    toast.error("Failed to create post");
  } finally {
    CreateLoader.value = false;
  }
}
const role = localStorage.getItem("role");
const backUrl = role === "admin" ? "/admin/dashboard" : "/user/dashboard";
</script>
<template>
  <App>
    <div class="w-full flex gap-3 p-3">
      <BackBtn class="mb-4" :url="backUrl" />
      <h1 class="text-white text-3xl w-fit max-sm:text-xl">Create Post</h1>
    </div>
    <div class="w-full flex justify-center">
      <form class="w-3/4 text-white" @submit.prevent="submitCreatePost">
        <div class="w-full my-3">
          <label for="post-title" class="text-lg">Title</label>
          <InputError :messages="createFormErrors.title" />
          <input
            v-model="createForm.title"
            id="post-title"
            name="title"
            type="text"
            required
            placeholder="Post Title"
            class="mt-2.5 block w-full bg-gray-800 rounded-lg border-0 py-2 pl-5 text-lg ring-1 ring-gray-200 ring-inset placeholder:text-sm focus:ring-2 focus:ring-gray-500 focus:ring-inset" />
        </div>
        <div class="w-full my-3">
          <label for="post-content" class="text-lg">Content</label>
          <InputError :messages="createFormErrors.content" />
          <textarea
            v-model="createForm.content"
            id="post-content"
            name="content"
            required
            placeholder="Content"
            rows="4"
            class="mt-2.5 block w-full bg-gray-800 rounded-lg border-0 py-2 pl-5 text-lg ring-1 ring-gray-200 ring-inset placeholder:text-sm focus:ring-2 focus:ring-gray-500 focus:ring-inset"></textarea>
        </div>
        <div class="w-full my-3">
          <label for="post-status" class="text-lg">Status</label>
          <InputError :messages="createFormErrors.status" />
          <select
            v-model="createForm.status"
            id="post-status"
            name="status"
            required
            class="mt-2.5 block w-full bg-gray-800 rounded-lg border-0 py-2 pl-5 text-lg ring-1 ring-gray-200 ring-inset placeholder:text-sm focus:ring-2 focus:ring-gray-500 focus:ring-inset">
            <option value="published">Published</option>
            <option value="draft">Draft</option>
          </select>
        </div>
        <div class="w-full my-3 flex justify-end px-5">
          <button
            type="submit"
            class="flex h-fit w-fit justify-center items-center bg-blue-600 text-lg rounded-lg p-2.5 text-white cursor-pointer hover:bg-blue-800">
            Create <Loader v-if="CreateLoader" class="animate-spin ml-2" />
          </button>
        </div>
      </form>
    </div>
  </App>
</template>
