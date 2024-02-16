<script setup>
import { ref, onMounted, watch } from 'vue'
// import AppLayout from '@/Layouts/AppLayout.vue';
import Create from './Create.vue';
import Modal from '@/Components/Modal.vue';
import Sidebar from '../Sidebar.vue'
import Pagination from '@/Components/Pagination.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SearchFilter from '@/Components/SearchFilter.vue';

import { pickBy, mapValues, debounce } from 'lodash'
import { router, Link } from '@inertiajs/vue3'

import { initFlowbite } from 'flowbite';

const props = defineProps({
  leaves: {
    type: Object,
    default: () => ({ data: [] })
  },
  filters: {
    type: Object
  },
  leaveTypes: {
    type: Object
  }
});

const filters = __props.filters;

const form = ref({
  search: filters?.search || '',
  // trashed: filters?.trashed || false,
});

const showModal = ref(false);

const openCreateLeaveModal = () => {
  showModal.value = true;
};

const closeCreateLeaveModal = () => {
  showModal.value = false;
};

watch(
  form.value,
  debounce(() => {
    router.get('/hr/leave', pickBy(form.value), { preserveState: true })
  }, 500),
  { deep: true }
);

function reset() {
  form.value = mapValues(form.value, () => null);
  router.get('/hr/leave');
}

onMounted(() => {
  initFlowbite();
})

// Handle form submission event from Create.vue
const handleFormSubmitted = () => {
  closeCreateLeaveModal()
};
</script>
  
<template>
  <!-- <AppLayout title="HR Dashboard"> -->
    <!-- <template #header>
      <h2 class="-mx-40 font-semibold text-xl text-gray-800 leading-tight">
        Human Resource
      </h2>
    </template> -->
    <head title="HR Dashboard"></head>
    <div class="flex">
      
      <Sidebar />

      <div class="flex-1 max-w-full">
        <div class="mt-4 mx-auto sm:px-2 lg:px-4">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <div class="justify-center">
              <div class="p-2 lg:p-4 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-medium text-gray-900">
                  Manage Leave
                </h1>
              </div>

              <div class="bg-gray-200 bg-opacity-25 lg:gap-8 p-2 lg:p-4">
                <!-- <div> -->
                  <div class="flex items-center justify-between ml-6 mr-6 mb-3 mt-3">
                    <search-filter v-model="form.search" class="mr-2 w-full max-w-md" @reset="reset">
                      <label class="block text-gray-800">Trashed:</label>
                      <select v-model="form.trashed" class="form-select mt-5 w-full">
                      </select>
                    </search-filter>

                    <PrimaryButton @click="openCreateLeaveModal">
                    <!-- <PrimaryButton> -->
                      <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="12" cy="12" r="9" fill="#FFFFFF" fill-opacity="0.9"/>
                      <path d="M12 15L12 9" stroke="#222222" stroke-width="1.2" stroke-linecap="square"/>
                      <path d="M15 12L9 12" stroke="#222222" stroke-width="1.2" stroke-linecap="square"/>
                      </svg>
                      <span class="ml-2">New Leave</span>  
                    </PrimaryButton>

                    <!-- Modal for Create Leave -->
                    <Modal :show="showModal" @close="closeCreateLeaveModal">
                        <Create 
                            @formSubmitted="handleFormSubmitted"
                            :leaveTypes="leaveTypes"
                        />
                    </Modal>

                    <!-- Modal for View Leave -->
                    <!-- <Modal :show="showViewModal" @close="closeViewRequestModal">
                      <View :id="idForView"/>
                    </Modal> -->
                  </div>

                  <table class="max-w-full table-auto ml-6 mr-6 mb-2 border-collapse">
                        <thead class="bg-gray-300 text-black text-center font-bold">
                            <tr class="text-center font-bold">
                              <th class="pb-2 pt-2 px-20 uppercase">Type</th>
                              <th class="pb-2 pt-2 px-10 uppercase">Start</th>
                              <th class="pb-2 pt-2 px-10 uppercase">End</th>
                              <th class="pb-2 pt-2 px-10 uppercase">Duration</th>
                              <th class="pb-2 pt-2 px-10 uppercase">Number of Days</th>
                              <th class="pb-2 pt-2 px-10 uppercase">Status</th>
                              <th class="pb-2 pt-2 px-10 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="leave in leaves.data" :key="leave.id" class="hover:bg-gray-100 focus-within:bg-gray-100 border-t-2">
                                <td class="w-5/10 text-left pl-2 border-solid border-top-1 border-sky-500">
                                    {{ leave.leaveType }}
                                </td>
                                <td class="w-1/10 text-center text-balance">
                                    {{ leave.start_date  }}
                                </td>
                                <td class="w-1/10 text-center text-balance">
                                    {{ leave.end_date  }}
                                </td>
                                <td class="w-1/10 text-center text-balance">
                                    {{ leave.leave_duration }}
                                </td>
                                <td class="w-1/10 text-center text-balance">
                                    {{ 5 }}
                                </td>
                                <td class="w-1/10 text-center text-balance">
                                    {{ leave.status }}
                                </td>
                                <td class="border-t text-center">
                                  <div class="inline-flex" >
                                    <svg @click="openViewRequestModal(request.id)" class="cursor-pointer" width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M20.188 10.9343C20.5762 11.4056 20.7703 11.6412 20.7703 12C20.7703 12.3588 20.5762 12.5944 20.188 13.0657C18.7679 14.7899 15.6357 18 12 18C8.36427 18 5.23206 14.7899 3.81197 13.0657C3.42381 12.5944 3.22973 12.3588 3.22973 12C3.22973 11.6412 3.42381 11.4056 3.81197 10.9343C5.23206 9.21014 8.36427 6 12 6C15.6357 6 18.7679 9.21014 20.188 10.9343Z" fill="#2A4157" fill-opacity="0.24"/>
                                      <circle cx="12" cy="12" r="3" fill="#222222"/>
                                    </svg>

                                    <svg @click="openEditRequestModal" class="cursor-pointer" width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M13.5 5.5L6.45321 12.5468C6.22845 12.7716 6.11607 12.8839 6.04454 13.0229C5.97301 13.1619 5.94689 13.3187 5.89463 13.6322L5.11508 18.3095C5.06262 18.6243 5.03639 18.7817 5.12736 18.8726C5.21833 18.9636 5.37571 18.9374 5.69048 18.8849L10.3678 18.1054L10.3678 18.1054C10.6813 18.0531 10.8381 18.027 10.9771 17.9555C11.1161 17.8839 11.2284 17.7716 11.4532 17.5468L11.4532 17.5468L18.5 10.5C19.5171 9.48295 20.0256 8.97442 20.1384 8.36277C20.1826 8.12295 20.1826 7.87705 20.1384 7.63723C20.0256 7.02558 19.5171 6.51705 18.5 5.5C17.4829 4.48295 16.9744 3.97442 16.3628 3.8616C16.1229 3.81737 15.8771 3.81737 15.6372 3.8616C15.0256 3.97442 14.5171 4.48294 13.5 5.5Z" fill="#2A4157" fill-opacity="0.24"/>
                                      <path d="M12.2929 6.70711L6.45321 12.5468C6.22845 12.7716 6.11607 12.8839 6.04454 13.0229C5.97301 13.1619 5.94689 13.3187 5.89463 13.6322L5.11508 18.3095C5.06262 18.6243 5.03639 18.7817 5.12736 18.8726C5.21833 18.9636 5.37571 18.9374 5.69048 18.8849L10.3678 18.1054L10.3678 18.1054C10.6813 18.0531 10.8381 18.027 10.9771 17.9555C11.1161 17.8839 11.2284 17.7716 11.4532 17.5468L11.4532 17.5468L17.2929 11.7071C17.6262 11.3738 17.7929 11.2071 17.7929 11C17.7929 10.7929 17.6262 10.6262 17.2929 10.2929L17.2929 10.2929L13.7071 6.70711C13.3738 6.37377 13.2071 6.20711 13 6.20711C12.7929 6.20711 12.6262 6.37377 12.2929 6.70711Z" fill="#222222"/>
                                    </svg>
                                  </div>
                                </td>
                            </tr>
                            <tr v-if="leaves.data.length === 0">
                            <td class="px-6 py-4 border-t" colspan="4">No leaves found.</td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination class="mt-3 p-2 lg:p-4" :links="leaves.links" />
                <!-- </div> -->
            </div>
            
          </div>
          
          </div>
        </div>
      </div>
    </div>
  <!-- </AppLayout> -->
</template>
  