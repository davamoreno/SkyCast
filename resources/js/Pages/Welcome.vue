<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: { type: Boolean },
    canRegister: { type: Boolean },
    laravelVersion: { type: String, required: true },
    phpVersion: { type: String, required: true },
});
</script>

<template>
    <Head title="SkyCast" />
    
    <div class="relative min-h-screen flex flex-col items-center selection:bg-indigo-500 selection:text-white overflow-hidden font-sans text-white">
        
        <div class="absolute inset-0 -z-10 h-full w-full bg-slate-950">
            <div class="absolute bottom-0 left-[-20%] right-0 top-[-10%] h-[500px] w-[500px] rounded-full bg-purple-500/20 opacity-50 blur-[80px]"></div>
            <div class="absolute bottom-[-10%] right-[-20%] h-[500px] w-[500px] rounded-full bg-indigo-500/20 opacity-50 blur-[80px]"></div>
            <div class="absolute top-[20%] left-[30%] h-[300px] w-[600px] rounded-full bg-blue-500/10 opacity-30 blur-[100px]"></div>
        </div>

        <header class="w-full max-w-7xl mx-auto p-6 flex justify-between items-center z-20">
            <div class="flex items-center gap-2">
                <div class="bg-gradient-to-tr from-indigo-500 to-purple-500 p-2 rounded-lg shadow-lg shadow-indigo-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight">SkyCast</span>
            </div>

            <nav v-if="canLogin" class="flex gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('weather')"
                    class="px-5 py-2 rounded-full bg-white/10 border border-white/10 hover:bg-white/20 transition backdrop-blur-md font-medium text-sm"
                >
                    Dashboard
                </Link>

                <template v-else>
                    <Link
                        :href="route('login')"
                        class="px-5 py-2 rounded-full hover:bg-white/10 transition font-medium text-sm text-white/80 hover:text-white"
                    >
                        Log in
                    </Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="px-5 py-2 rounded-full bg-indigo-600 hover:bg-indigo-500 shadow-lg shadow-indigo-500/30 transition font-medium text-sm"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>

        <main class="flex-1 flex flex-col justify-center items-center text-center px-4 z-10 w-full max-w-4xl mx-auto mt-10 sm:mt-0">
            
            <div class="mb-6 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-900/30 border border-indigo-500/30 text-indigo-300 text-xs font-semibold uppercase tracking-wide">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                Live Weather Data
            </div>

            <h1 class="text-5xl sm:text-7xl font-black tracking-tight mb-6 bg-clip-text text-transparent bg-gradient-to-b from-white to-white/60 drop-shadow-sm">
                Predict the <br /> Unpredictable.
            </h1>

            <p class="text-lg sm:text-xl text-slate-400 mb-10 max-w-2xl leading-relaxed">
                Experience the most accurate real-time weather tracking with our beautiful, data-driven dashboard. Powered by OpenWeatherMap.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                <Link 
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')" 
                    class="px-8 py-4 rounded-full bg-white text-slate-900 font-bold hover:bg-slate-200 transition shadow-xl shadow-white/10 flex items-center justify-center gap-2"
                >
                    Check Weather Now
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </Link>
                <Link 
                    v-else
                    :href="route('register')" 
                    class="px-8 py-4 rounded-full bg-white text-slate-900 font-bold hover:bg-slate-200 transition shadow-xl shadow-white/10 flex items-center justify-center gap-2"
                >
                    Get Started Free
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </Link>

                <a href="https://openweathermap.org/" target="_blank" class="px-8 py-4 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 transition text-white font-semibold backdrop-blur-sm">
                    Learn API
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-20 w-full text-left">
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm hover:bg-white/10 transition">
                    <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center mb-4 text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-1">Real-Time</h3>
                    <p class="text-slate-400 text-sm">Instant data updates directly from global satellites.</p>
                </div>
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm hover:bg-white/10 transition">
                    <div class="w-10 h-10 rounded-lg bg-purple-500/20 flex items-center justify-center mb-4 text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-1">Global Coverage</h3>
                    <p class="text-slate-400 text-sm">Check weather conditions for any city worldwide.</p>
                </div>
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm hover:bg-white/10 transition">
                    <div class="w-10 h-10 rounded-lg bg-green-500/20 flex items-center justify-center mb-4 text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-1">99.9% Accuracy</h3>
                    <p class="text-slate-400 text-sm">Reliable forecasts you can trust for your day.</p>
                </div>
            </div>
        </main>

        <footer class="w-full p-6 text-center text-slate-500 text-xs z-10">
            <p>Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }}) • Weather App Challenge</p>
        </footer>
    </div>
</template>