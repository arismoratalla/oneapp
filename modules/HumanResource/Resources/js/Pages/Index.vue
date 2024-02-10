<template>
    <AppLayout title="HR Dashboard">
        <div>
        <h1>{{ message }}</h1>
        <!-- Your page content goes here -->
        </div>
    </AppLayout>
  </template>
  
  <script setup>
  import AppLayout from '@/Layouts/AppLayout.vue'
  import { ref, onMounted } from 'vue';
  
  // Define your component data
  const message = ref('');
  
  // Define your component methods
  const fetchData = () => {
    // Perform data fetching logic, if needed
    // For example, you can make an Axios request here
    message.value = 'Hello from Human Resource Module!';
  };
  
  // Use the onMounted hook to execute code when the component is mounted
  onMounted(() => {
    fetchData();
  });
  </script>
  
  <style scoped>
  /* Your component styles go here */
  </style>
  