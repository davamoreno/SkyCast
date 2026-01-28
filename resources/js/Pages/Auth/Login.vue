<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-slate-950 font-sans selection:bg-indigo-500 selection:text-white">
        
        <div class="absolute inset-0 -z-10 h-full w-full">
            <div class="absolute bottom-0 left-[-20%] right-0 top-[-10%] h-[500px] w-[500px] rounded-full bg-purple-500/20 opacity-50 blur-[80px]"></div>
            <div class="absolute bottom-[-10%] right-[-20%] h-[500px] w-[500px] rounded-full bg-indigo-500/20 opacity-50 blur-[80px]"></div>
            <div class="absolute top-[20%] left-[30%] h-[300px] w-[600px] rounded-full bg-blue-500/10 opacity-30 blur-[100px]"></div>
        </div>

        <div class="w-full max-w-md p-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl relative z-10 animate-fade-in">
            
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-500 mb-4 shadow-lg shadow-indigo-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-white tracking-tight">Welcome Back</h2>
                <p class="text-slate-400 text-sm mt-2">Please sign in to your SkyCast account</p>
            </div>

            <div v-if="status" class="mb-4 text-sm font-medium text-green-400 bg-green-400/10 p-3 rounded-lg border border-green-400/20 text-center">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-1">Email Address</label>
                    <div class="relative">
                        <input
                            id="email"
                            type="email"
                            class="w-full bg-black/20 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition shadow-inner"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="name@example.com"
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                    </div>
                    <InputError class="mt-2 text-red-400" :message="form.errors.email" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-1">Password</label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            class="w-full bg-black/20 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition shadow-inner"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                        />
                         <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <InputError class="mt-2 text-red-400" :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" class="text-indigo-500 bg-white/10 border-white/20 rounded focus:ring-indigo-500 focus:ring-offset-slate-900" />
                        <span class="ms-2 text-sm text-slate-400">Remember me</span>
                    </label>

                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-indigo-400 hover:text-indigo-300 transition"
                    >
                        Forgot password?
                    </Link>
                </div>

                <div>
                    <button
                        type="submit"
                        :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                        :disabled="form.processing"
                        class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold rounded-lg shadow-lg shadow-indigo-500/30 transition transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900"
                    >
                        Log in
                    </button>
                </div>

                <div class="mt-6 text-center text-sm text-slate-500">
                    Don't have an account? 
                    <Link :href="route('register')" class="text-indigo-400 hover:text-white font-medium transition">
                        Sign up now
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>

<style>
/* Animasi Fade In */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}
</style>