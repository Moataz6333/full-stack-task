<template>
  <Modal v-model:show="show" :title="'Edit Post'">
    <form @submit.prevent="handleSubmit">
      <div class="mb-4">
        <label class="block text-gray-200 mb-1">Title</label>
        <input
          v-model="form.title"
          type="text"
          class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600 focus:border-blue-500"
          placeholder="Enter post title" />
        <InputError v-if="errors && errors.title" :messages="errors.title" />
      </div>
      <div class="mb-4">
        <label class="block text-gray-200 mb-1">Content</label>
        <textarea
          v-model="form.content"
          class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600 focus:border-blue-500"
          rows="4"
          placeholder="Enter post content"></textarea>
        <InputError
          v-if="errors && errors.content"
          :messages="errors.content" />
      </div>
      <div class="mb-4">
        <label class="block text-gray-200 mb-1">Status</label>
        <select
          v-model="form.status"
          class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600 focus:border-blue-500">
          <option value="published">Published</option>
          <option value="draft">Draft</option>
        </select>
        <InputError v-if="errors && errors.status" :messages="errors.status" />
      </div>
      <div class="flex justify-end gap-2">
        <button
          type="button"
          class="px-4 py-2 rounded bg-gray-700 text-white hover:bg-gray-600"
          @click="$emit('update:show', false)">
          Cancel
        </button>
        <button
          type="submit"
          class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-800"
          :disabled="loading">
          <span v-if="loading">Saving...</span>
          <span v-else>Save</span>
        </button>
      </div>
    </form>
  </Modal>
</template>

<script setup>
import { ref, watch, computed } from "vue";
import Modal from "@/components/Modal.vue";
import InputError from "@/components/InputError.vue";
import { useToast } from "vue-toastification";
import api from "@/axios";
import { serverUrl } from "@/config";

const props = defineProps({
  show: Boolean,
  post: Object,
});
const emit = defineEmits(["update:show", "updated"]);

const show = computed({
  get: () => props.show,
  set: (v) => emit("update:show", v),
});

const form = ref({
  title: "",
  content: "",
  status: "published",
});
const errors = ref({});
const loading = ref(false);
const toast = useToast();

watch(
  () => props.post,
  (newPost) => {
    if (newPost) {
      form.value.title = newPost.title || "";
      form.value.content = newPost.content || "";
      form.value.status = newPost.status || "published";
      errors.value = {};
    }
  },
  { immediate: true }
);

async function handleSubmit() {
  errors.value = {};
  loading.value = true;
  const role =localStorage.getItem('role');
  const updateUrl= role=='admin' ? 'update-post' : 'update-mypost';
  try {
    const response = await api.post(
      `${serverUrl}/${updateUrl}/${props.post.id}`,
      form.value
    );
    if (response.status === 200) {
      toast.success("Post updated successfully");
      emit("updated", response.data.post);
      emit("update:show", false);
    } else {
      toast.error("Failed to update post");
    }
  } catch (error) {
    if (error.response && error.response.data) {
      if (error.response.data.errors) {
        errors.value = error.response.data.errors;
      } else if (typeof error.response.data === "object") {
        errors.value = error.response.data;
      } else {
        toast.error("Failed to update post");
      }
    } else {
      toast.error("Failed to update post");
    }
  } finally {
    loading.value = false;
  }
}
</script>
