<script setup>
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Password" />

    <div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-slate-950 font-sans selection:bg-indigo-500 selection:text-white">
        <div class="absolute inset-0 -z-10 h-full w-full">
             <div class="absolute bottom-[-10%] right-[-20%] h-[500px] w-[500px] rounded-full bg-indigo-500/20 opacity-50 blur-[80px]"></div>
             <div class="absolute top-[20%] left-[30%] h-[300px] w-[600px] rounded-full bg-blue-500/10 opacity-30 blur-[100px]"></div>
        </div>

        <div class="w-full max-w-md p-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl relative z-10 animate-fade-in">
            
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-white">New Password</h2>
                <p class="text-slate-400 text-sm mt-1">Please enter your new password below.</p>
            </div>

            <form @submit.prevent="submit" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Email</label>
                    <input
                        type="email"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-slate-400 cursor-not-allowed"
                        v-model="form.email"
                        required
                        readonly
                    />
                    <InputError class="mt-2 text-red-400" :message="form.errors.email" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-1">New Password</label>
                    <input
                        id="password"
                        type="password"
                        class="w-full bg-black/20 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:ring-2 focus:ring-indigo-500 outline-none transition"
                        v-model="form.password"
                        required
                        autofocus
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />
                    <InputError class="mt-2 text-red-400" :message="form.errors.password" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-1">Confirm Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        class="w-full bg-black/20 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:ring-2 focus:ring-indigo-500 outline-none transition"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />
                    <InputError class="mt-2 text-red-400" :message="form.errors.password_confirmation" />
                </div>

                <div class="pt-2">
                    <button
                        :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                        :disabled="form.processing"
                        class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold rounded-lg shadow-lg shadow-indigo-500/30 transition transform hover:scale-[1.02]"
                    >
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>