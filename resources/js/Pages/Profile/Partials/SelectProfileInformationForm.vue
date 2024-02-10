<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
// import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    employee: Object,
});

const form = useForm({
    _method: 'PUT',
    status: props.employee.status_id,
    employee_number: props.employee.employee_number,
    position: props.employee.position,
    division: props.employee.division,
    unit: props.employee.unit,
    mobile: props.employee.mobile
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('employee-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-employee-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            Employee Profile Information
        </template>

        <template #description>
            Update your employee information.
        </template>

        <template #form>
            <!-- Employee Number -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="employee_number" value="Employee Number" />
                <TextInput
                    id="employee_number"
                    v-model="form.employee_number"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="employee_number"
                />
                <InputError :message="form.errors.employee_number" class="mt-2" />
            </div>

            <!-- Status Id -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="status_id" value="Status" />
                <TextInput
                    id="status_id"
                    v-model="form.status_id"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="status_id"
                />
                <InputError :message="form.errors.status_id" class="mt-2" />
            </div>

            <!-- Position -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="position" value="Position" />
                <TextInput
                    id="position"
                    v-model="form.position"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="position"
                />
                <InputError :message="form.errors.position" class="mt-2" />
            </div>

            <!-- Division -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="division" value="Division" />
                <TextInput
                    id="division"
                    v-model="form.division"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="division"
                />
                <InputError :message="form.errors.division" class="mt-2" />
            </div>

            <!-- Unit -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="unit" value="Unit" />
                <TextInput
                    id="unit"
                    v-model="form.unit"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="unit"
                />
                <InputError :message="form.errors.unit" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
