<script setup>
import { onMounted } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Sidbar from '@/Layouts/Sidebar.vue';
import { initFlowbite } from 'flowbite';

onMounted(() => {
    initFlowbite();
})
</script>
  
<template>
    <AppLayout title="HR Dashboard">
        <template #header>
            <h2 class="-mx-40 font-semibold text-xl text-gray-800 leading-tight">
                Human Resource
            </h2>
        </template>

        
        <div class="flex">
          <Sidbar />
          <div class="flex-1 max-w-full">
            <div class="mt-4 mx-auto sm:px-2 lg:px-4">
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <Welcome />  
              </div>
            </div>
          </div>
          
        </div>
    </AppLayout>
</template>
  