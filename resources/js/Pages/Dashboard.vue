<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Skycast - Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-bold leading-tight text-white">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="overflow-hidden bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl rounded-3xl p-8 animate-fade-in">
                        <h3 class="text-2xl font-bold text-white mb-2">Welcome back, {{ $page.props.auth.user.name }}! 👋</h3>
                        <p class="text-slate-400 mb-6">
                            Ready to explore the skies? You have full access to our global weather tracking system.
                        </p>
                        
                        <div class="flex items-center gap-4 text-sm text-slate-500">
                            <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 border border-green-500/20">System Online</span>
                            <span>{{ new Date().toLocaleDateString() }}</span>
                        </div>
                    </div>

                    <div class="overflow-hidden bg-gradient-to-br from-indigo-600/20 to-purple-600/20 backdrop-blur-xl border border-indigo-500/30 shadow-2xl rounded-3xl p-8 flex flex-col justify-center items-start hover:border-indigo-500/50 transition duration-300 animate-fade-in delay-100">
                        <div class="mb-4 bg-indigo-500 p-3 rounded-xl shadow-lg shadow-indigo-500/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Check Real-Time Weather</h3>
                        <p class="text-indigo-200 mb-6 text-sm">
                            Get instant forecast updates for any city in the world.
                        </p>
                        
                        <Link :href="route('weather')" class="px-6 py-3 rounded-xl bg-white text-indigo-900 font-bold hover:bg-indigo-50 transition shadow-lg shadow-white/10 flex items-center gap-2">
                            Launch App
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </Link>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.delay-100 {
    animation-delay: 100ms;
}
</style>