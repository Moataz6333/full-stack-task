<script setup>
const props=defineProps({
    messages:Array
});
</script>

<template>
    <div v-show="messages">
        <ul class="text-sm text-red-600 dark:text-red-500">
            <li v-for="message in props.messages">{{ message }}</li>
        </ul>
    </div>
</template>
