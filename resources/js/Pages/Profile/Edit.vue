<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-bold leading-tight text-white">
                Profile Settings
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-4 shadow-2xl sm:rounded-3xl sm:p-8 animate-fade-in">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-4 shadow-2xl sm:rounded-3xl sm:p-8 animate-fade-in delay-100">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="bg-red-900/10 backdrop-blur-xl border border-red-500/20 p-4 shadow-2xl sm:rounded-3xl sm:p-8 animate-fade-in delay-200">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.delay-100 { animation-delay: 100ms; }
.delay-200 { animation-delay: 200ms; }
</style>