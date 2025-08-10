<script setup>
import App from "@/layouts/App.vue";
import { onMounted, ref } from "vue";
import { serverUrl } from "@/config.js";
import PulseLoader from "vue-spinner/src/PulseLoader.vue";
import { useRouter, RouterLink } from "vue-router";
import BackBtn from "@/components/BackBtn.vue";
import api from "@/axios";
import {
  Plus,
  XCircle,
  ThumbsUp,
  MessageCircle,
  Edit,
  Trash2,
} from "lucide-vue-next";
import Pagination from "@/components/Pagination.vue";
import profile from "@/assets/profile.jfif";
import EditPostModal from "@/components/EditPostModal.vue";
import { useToast } from "vue-toastification";
const toast = useToast();   
const isLoading = ref(false);
const hasPosts = ref(false);
const posts = ref([]);

const currentPage = ref(1);
const lastPage = ref(1);
const total = ref(0);
async function fetchPosts(page = 1) {
  isLoading.value = true;
  try {
    const response = await api.get(`${serverUrl}/posts?page=${page}`);
    if (response.status === 200) {
      posts.value = response.data.posts;
      currentPage.value = response.data.current_page || 1;
      lastPage.value = response.data.last_page || 1;
      total.value = response.data.total || 0;
      hasPosts.value = posts.value.length > 0;
    } else {
      hasPosts.value = false;
    }
  } catch (error) {
    hasPosts.value = false;
    toast.error("Failed to fetch posts");
  } finally {
    isLoading.value = false;
  }
}
// edit modal
const showEditModal = ref(false);
const selectedPost = ref(null);
function openEditModal(post) {
  selectedPost.value = { ...post };
  showEditModal.value = true;
}
function handlePostUpdated(updatedPost) {
  // Update the post in the posts list
  const idx = posts.value.findIndex((p) => p.id === updatedPost.id);
  if (idx !== -1) {
    posts.value[idx] = { ...updatedPost };
  }
}

// delete post
async function handleDeletePost(post) {
  if (!window.confirm("Are you sure you want to delete this post?")) return;
  try {
    const response = await api.delete(`${serverUrl}/delete-post/${post.id}`);
    if (response.status === 200) {
      toast.success("Post deleted successfully");
      // Remove the post from the posts list
      posts.value = posts.value.filter((p) => p.id !== post.id);
      if (posts.value.length === 0 && currentPage.value > 1) {
        // If no posts left on this page, go to previous page
        fetchPosts(currentPage.value - 1);
      }
    } else {
      toast.error("Failed to delete post");
    }
  } catch (error) {
    toast.error("Failed to delete post");
  }
}

onMounted(() => {
  fetchPosts();
});
function handlePageChange(page) {
  fetchPosts(page);
}
// ago time
function formatRelativeTime(dateString) {
  if (!dateString) return "";
  const now = new Date();
  const date = new Date(dateString);
  const diff = Math.floor((now - date) / 1000);
  if (diff < 60)
    return `${diff} sec
          ago`;
  if (diff < 3600) return `${Math.floor(diff / 60)} min ago`;
  if (diff < 86400) return `${Math.floor(diff / 3600)} hr ago`;
  return;
  date.toLocaleDateString();
}
</script>
<template>
  <App>
    <!-- create -->
    <div class="flex w-full justify-center my-3">
      <RouterLink
        to="/create-post"
        class="flex h-fit w-fit justify-center items-center bg-blue-600 text-white text-md rounded-lg p-2 cursor-pointer hover:bg-blue-800">
        Create Post
      </RouterLink>
    </div>

    <!-- loading -->
    <div v-if="isLoading" class="w-full flex justify-center mt-5 items-center">
      <PulseLoader color="blue" />
    </div>
    <div v-else class="w-full ">
      <div class="w-full flex flex-col items-center gap-4 mt-4" v-if="hasPosts">
        <div
          v-for="post in posts"
          :key="post.id"
          class="bg-gray-900 border w-3/4 border-gray-700 rounded-lg p-4 mb-3  transition hover:shadow-lg hover:border-blue-500 hover:bg-gray-800">
          <!-- profile details -->
          <div class="flex justify-between items-center mb-3">
            <div class="flex items-center gap-4">
              <img
                :src="profile"
                alt="Profile"
                class="w-12 h-12 rounded-full object-cover border border-gray-700" />
              <div>
                <div class="text-white font-semibold">
                  {{ post.user?.name }}
                </div>
                <div class="text-gray-400 text-sm">{{ post.user?.email }}</div>
                <div class="text-gray-500 text-xs capitalize">
                  {{ post.user?.role }}
                </div>
              </div>
            </div>
            <div class="flex flex-col items-end">
              <div class="text-gray-400 text-xs mb-1">
                {{ formatRelativeTime(post.created_at) }}
              </div>
              <div
                :class="[
                  'text-xs px-2 py-1 rounded',
                  post.status === 'published'
                    ? 'bg-green-700 text-white'
                    : 'bg-yellow-700 text-white',
                ]">
                {{ post.status }}
              </div>
            </div>
          </div>

          <div class="flex justify-between items-center mb-2">
            <h2 class="text-xl font-semibold text-white">
              {{ post.title }}
            </h2>
            <div class="flex gap-2">
              <button class="p-1 rounded hover:bg-blue-800" title="Edit">
                <Edit class="text-blue-400" size="20"  @click.stop="openEditModal(post)" />
              </button>
              <button
                class="p-1 rounded hover:bg-red-800"
                title="Delete"
                @click.stop="handleDeletePost(post)">
                <Trash2 class="text-red-400" size="20" />
              </button>
            </div>
          </div>
          <div class="text-gray-200 mb-2 cursor-pointer">
            {{ post.content }}
          </div>
        </div>
        <!-- edit modal -->
        <EditPostModal
          v-if="selectedPost"
          v-model:show="showEditModal"
          :post="selectedPost"
          @updated="handlePostUpdated" />
        <div class="flex justify-center mt-6">
          <Pagination
            :currentPage="currentPage"
            :lastPage="lastPage"
            :total="total"
            @page-change="handlePageChange" />
        </div>
      </div>
      <div v-else class="w-full flex justify-center items-center py-8">
        <h2 class="text-gray-400 text-xl">No posts found.</h2>
      </div>
    </div>
  </App>
</template>
