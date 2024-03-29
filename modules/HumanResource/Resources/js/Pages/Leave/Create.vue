<script setup>
    import { ref, reactive, defineProps } from 'vue';
    import { router, useForm } from '@inertiajs/vue3';

    const processing = ref(false);

    const props = defineProps({
        leaveTypes: {
            type: Object
        }
    });

    const emit = defineEmits(['formSubmitted']);

    const leaveForm = useForm({
        leave_type_id: '',
        start_date: '',
        end_date: '',
        reason: '',
    });

    const submitForm = async () => {
        processing.value = true;

        setTimeout(async () => {
            try {
                await leaveForm.post(route('leave.store'), {
                    onFinish: () => {
                        emit('formSubmitted');
                    }
                });
            } catch (error) {
                console.error('Error submitting form:', error);
            } finally {
                processing.value = false;
            }
        }, 1000);
    };
</script>

<template>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label for="leave_type_id" class="block text-sm font-medium text-gray-600">
                    Leave Type
                </label>
                <select
                    id="leave_type_id"
                    v-model="leaveForm.leave_type_id"
                    class="mt-1 p-2 border rounded-md w-full"
                    required
                    >
                    <option value="">Select Leave Type</option>
                    <option v-for="leaveType in leaveTypes" :key="leaveType.id" :value="leaveType.id">
                        {{ leaveType.name }}
                    </option>
                </select>
            </div>

            <div class="flex">
                <div class="mb-4 mr-4 flex-1">
                    <label for="start_date" class="block text-sm font-medium text-gray-600">
                        Start Date
                    </label>
                    <input
                        type="date"
                        id="start_date"
                        v-model="leaveForm.start_date"
                        class="mt-1 p-2 border rounded-md w-full"
                        required
                    />
                </div>

                <div class="mb-4 ml-4 flex-1">
                    <label for="end_date" class="block text-sm font-medium text-gray-600">
                        End Date
                    </label>
                    <input
                        type="date"
                        id="end_date"
                        v-model="leaveForm.end_date"
                        class="mt-1 p-2 border rounded-md w-full"
                        required
                    />
                </div>
            </div>
            <div class="mb-4">
                <label for="reason" class="block text-sm font-medium text-gray-600">
                    Reason
                </label>
                <textarea
                id="reason"
                v-model="leaveForm.reason"
                class="mt-1 p-2 border rounded-md w-full"
                required
                ></textarea>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md mr-2" :disabled="processing">
                <template v-if="processing">
                    <svg aria-hidden="true" class="inline w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    Processing...
                </template>

                <template v-else>
                    Create Leave
                </template>
                </button>
            </div>
        </form>
    </div>
</template>