<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Props dari Action
const props = defineProps({ weather: Object, error: String, filters: Object });

const form = useForm({
    city: props.filters?.city || '',
});

const submit = () => {
    form.get(route('weather'), { preserveState: true });
};

// Logika Ganti Warna Background Sesuai Cuaca
const getBackground = () => {
    if (!props.weather) return 'bg-gradient-to-br from-blue-900/50 via-slate-900 to-black'; // Default Darker
    
    const main = props.weather.weather[0].main.toLowerCase();
    
    // Warna kita buat lebih "Deep" biar nyatu sama Dark Mode Layout
    if (main.includes('cloud')) return 'bg-gradient-to-br from-gray-700/80 via-slate-800 to-slate-900'; 
    if (main.includes('rain') || main.includes('drizzle')) return 'bg-gradient-to-br from-blue-900/80 via-slate-900 to-black'; 
    if (main.includes('clear')) return 'bg-gradient-to-br from-orange-500/60 via-blue-600/60 to-slate-900'; 
    if (main.includes('thunder')) return 'bg-gradient-to-br from-purple-900/80 via-indigo-900 to-black'; 
    if (main.includes('snow')) return 'bg-gradient-to-br from-blue-200/50 via-slate-800 to-slate-900'; 
    
    return 'bg-gradient-to-br from-cyan-900/50 to-slate-900'; 
};
</script>

<template>
    <Head title="Skycast - Weather" />

    <AuthenticatedLayout>
        <div :class="[getBackground(), 'relative flex flex-col items-center justify-center p-4 transition-all duration-1000 ease-in-out font-sans min-h-[calc(100vh-65px)] overflow-hidden']">
            
            <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>

            <div class="w-full max-w-md bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl overflow-hidden text-white ring-1 ring-white/30 relative z-10 animate-fade-in">
                
                <div class="p-6 border-b border-white/10">
                    <form @submit.prevent="submit" class="relative group">
                        <input 
                            v-model="form.city" 
                            type="text" 
                            placeholder="Search City (e.g., Tokyo)" 
                            class="w-full bg-black/20 border-none rounded-full py-3 px-5 pr-12 text-white placeholder-white/60 focus:ring-2 focus:ring-white/50 focus:bg-black/30 transition-all outline-none shadow-inner"
                        >
                        <button 
                            type="submit" 
                            :disabled="form.processing"
                            class="absolute right-2 top-1/2 -translate-y-1/2 p-2 bg-white/20 rounded-full hover:bg-white/40 transition-colors disabled:opacity-50"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="p-8 text-center min-h-[400px] flex flex-col justify-center">
                    
                    <div v-if="error" class="bg-red-500/80 backdrop-blur-sm p-4 rounded-xl border border-red-400 animate-pulse">
                        <p class="font-bold">⚠️ Oops!</p>
                        <p class="text-sm">{{ error }}</p>
                    </div>

                    <div v-else-if="!weather" class="text-white/60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto mb-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-lg">Enter a location to explore.</p>
                    </div>

                    <div v-else class="animate-fade-in">
                        <h2 class="text-4xl font-bold drop-shadow-lg tracking-wide">
                            {{ weather.name }}<span class="text-xl text-white/70 font-light">, {{ weather.sys.country }}</span>
                        </h2>
                        
                        <div class="my-6">
                            <img 
                                :src="`https://openweathermap.org/img/wn/${weather.weather[0].icon}@4x.png`" 
                                class="w-40 h-40 mx-auto drop-shadow-2xl -my-4 filter brightness-110"
                                alt="Weather Icon"
                            >
                            <div class="text-8xl font-black tracking-tighter drop-shadow-2xl">
                                {{ Math.round(weather.main.temp) }}°
                            </div>
                            <p class="text-xl font-medium capitalize mt-2 text-white/90">{{ weather.weather[0].description }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-3 mt-8">
                            <div class="bg-white/10 p-3 rounded-2xl backdrop-blur-sm hover:bg-white/20 transition">
                                <p class="text-xs text-white/60 uppercase font-bold tracking-wider">Humidity</p>
                                <div class="flex items-center justify-center gap-2 mt-1">
                                    <span class="text-xl font-bold">💧 {{ weather.main.humidity }}%</span>
                                </div>
                            </div>
                            <div class="bg-white/10 p-3 rounded-2xl backdrop-blur-sm hover:bg-white/20 transition">
                                <p class="text-xs text-white/60 uppercase font-bold tracking-wider">Wind Speed</p>
                                <div class="flex items-center justify-center gap-2 mt-1">
                                    <span class="text-xl font-bold">💨 {{ weather.wind.speed }} m/s</span>
                                </div>
                            </div>
                            <div class="bg-white/10 p-3 rounded-2xl backdrop-blur-sm hover:bg-white/20 transition">
                                <p class="text-xs text-white/60 uppercase font-bold tracking-wider">Feels Like</p>
                                <div class="flex items-center justify-center gap-2 mt-1">
                                    <span class="text-xl font-bold">🌡️ {{ Math.round(weather.main.feels_like) }}°</span>
                                </div>
                            </div>
                            <div class="bg-white/10 p-3 rounded-2xl backdrop-blur-sm hover:bg-white/20 transition">
                                <p class="text-xs text-white/60 uppercase font-bold tracking-wider">Pressure</p>
                                <div class="flex items-center justify-center gap-2 mt-1">
                                    <span class="text-xl font-bold">🧭 {{ weather.main.pressure }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="bg-black/20 p-3 text-center text-xs text-white/40">
                    Weather App by You • OpenWeatherMap
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fadeIn 0.6s ease-out forwards;
}
</style>