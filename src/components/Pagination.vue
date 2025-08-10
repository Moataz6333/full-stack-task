<script setup>
import { ref, watch } from "vue";
const props = defineProps({
  currentPage: { type: Number, required: true },
  lastPage: { type: Number, required: true },
  total: { type: Number, required: true },
});
const emit = defineEmits(["page-change"]);
const pages = ref([]);

function updatePages() {
  const arr = [];
  for (let i = 1; i <= props.lastPage; i++) {
    arr.push(i);
  }
  pages.value = arr;
}

watch(() => [props.lastPage, props.currentPage], updatePages, {
  immediate: true,
});

function goToPage(page) {
  if (page !== props.currentPage) {
    emit("page-change", page);
  }
}
</script>
<template>
  <nav class="flex justify-center my-6">
    <ul class="inline-flex items-center space-x-2">
      <li>
        <button
          :disabled="props.currentPage === 1"
          @click="goToPage(props.currentPage - 1)"
          class="px-3 py-1 rounded bg-gray-800 text-white hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed">
          Prev
        </button>
      </li>
      <li v-for="page in pages" :key="page">
        <button
          @click="goToPage(page)"
          :class="[
            page === props.currentPage
              ? 'bg-blue-600 text-white font-bold'
              : 'bg-gray-800 text-white',
            'px-3 py-1 rounded hover:bg-blue-600 transition-colors',
          ]">
          {{ page }}
        </button>
      </li>
      <li>
        <button
          :disabled="props.currentPage === props.lastPage"
          @click="goToPage(props.currentPage + 1)"
          class="px-3 py-1 rounded bg-gray-800 text-white hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed">
          Next
        </button>
      </li>
    </ul>
  </nav>
</template>
