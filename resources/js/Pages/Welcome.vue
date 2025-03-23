<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { useScroll } from '@vueuse/core';
import { gsap } from 'gsap';
import { faDiscord, faTwitch } from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const scrollPosition = ref(0);
const { y } = useScroll(window);

const howItWorks = [
    {
        icon: faDiscord,
        title: 'Create Your Club',
        description: 'Set up your FIFA 24 Pro Club with custom colors, badges, and players.'
    },
    {
        icon: faTwitch,
        title: 'Compete in Tournaments',
        description: 'Join official tournaments and compete against other clubs for rewards.'
    },
    {
        icon: 'svg-users',
        title: 'Build Your Team',
        description: 'Recruit players, manage your squad, and develop your team strategy.'
    }
];

const stats = [
    {
        value: '1000',
        label: 'Active Clubs'
    },
    {
        value: '5000',
        label: 'Registered Players'
    },
    {
        value: '100',
        label: 'Tournaments'
    },
    {
        value: '50',
        label: 'Countries'
    }
];

const features = [
    {
        icon: 'svg-shield',
        title: 'Official Recognition',
        description: 'Get your club officially recognized in FIFA 24 Pro Clubs.'
    },
    {
        icon: 'svg-star',
        title: 'Rewards System',
        description: 'Earn rewards and recognition for tournament achievements.'
    },
    {
        icon: 'svg-globe',
        title: 'Global Community',
        description: 'Connect with players from around the world.'
    }
];

onMounted(() => {
    y.value = window.scrollY;
    window.addEventListener('scroll', () => {
        scrollPosition.value = window.scrollY;
    });

    // Animate stats numbers when they come into view
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const stat = entry.target;
                const target = parseInt(stat.dataset.target);
                gsap.to(stat, {
                    innerHTML: target,
                    duration: 2,
                    ease: 'power1.inOut',
                    snap: { innerHTML: 1 },
                    onComplete: () => {
                        stat.innerHTML = target;
                    }
                });
                statsObserver.unobserve(stat);
            }
        });
    }, {
        threshold: 0.1
    });

    // Observe all stat numbers
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => statsObserver.observe(stat));
});
</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen bg-gray-200 dark:bg-gray-900">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-primary to-secondary/90 backdrop-blur-md dark:from-primary/80 dark:to-secondary/70 shadow-lg">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <Link href="/" class="text-2xl font-bold text-white">
                        <div class="flex items-center gap-2">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                            <span>Pro Clubs</span>
                        </div>
                    </Link>

                    <div class="hidden md:flex items-center justify-center space-x-6">
                        <div class="relative group">
                            <button class="flex items-center px-4 py-2 text-white transition duration-300">
                                <div class="absolute -left-2 -top-2 h-6 w-6 rounded-full bg-white/20 group-hover:bg-white/30 dark:bg-white/10 dark:group-hover:bg-white/20"></div>
                                <span class="flex items-center gap-2">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                        <polyline points="7 22 7 12 12 7 17 12 17 22"/>
                                    </svg>
                                    Home
                                    <svg class="h-4 w-4 ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M6 9l6 6 6-6"/>
                                    </svg>
                                </span>
                            </button>
                            <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-gradient-to-r from-primary/10 to-secondary/10 backdrop-blur-md dark:from-primary/5 dark:to-secondary/5 ring-1 ring-primary/20 dark:ring-primary/10 group-hover:opacity-100 opacity-0 transition-opacity duration-300">
                                <div class="py-2">
                                    <a href="#" class="block px-6 py-3 text-base font-medium text-gray-200 hover:text-white dark:text-gray-200 dark:hover:text-white transition-all duration-200 hover:bg-primary/20 dark:hover:bg-primary/10 hover:rounded-md">News</a>
                                    <a href="#" class="block px-6 py-3 text-base font-medium text-gray-200 hover:text-white dark:text-gray-200 dark:hover:text-white transition-all duration-200 hover:bg-primary/20 dark:hover:bg-primary/10 hover:rounded-md">Events</a>
                                    <a href="#" class="block px-6 py-3 text-base font-medium text-gray-200 hover:text-white dark:text-gray-200 dark:hover:text-white transition-all duration-200 hover:bg-primary/20 dark:hover:bg-primary/10 hover:rounded-md">Updates</a>
                                </div>
                            </div>
                        </div>

                        <div class="relative group">
                            <button class="flex items-center px-4 py-2 text-white transition duration-300">
                                <div class="absolute -left-2 -top-2 h-6 w-6 rounded-full bg-white/20 group-hover:bg-white/30 dark:bg-white/10 dark:group-hover:bg-white/20"></div>
                                <span class="flex items-center gap-2">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                        <polyline points="22 4 12 14 4 4"/>
                                    </svg>
                                    Championships
                                    <svg class="h-4 w-4 ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M6 9l6 6 6-6"/>
                                    </svg>
                                </span>
                            </button>
                            <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-gradient-to-r from-primary/10 to-secondary/10 backdrop-blur-md dark:from-primary/5 dark:to-secondary/5 ring-1 ring-primary/20 dark:ring-primary/10 group-hover:opacity-100 opacity-0 transition-opacity duration-300">
                                <div class="py-2">
                                    <a href="#" class="block px-6 py-3 text-base font-medium text-gray-200 hover:text-white dark:text-gray-200 dark:hover:text-white transition-all duration-200 hover:bg-primary/20 dark:hover:bg-primary/10 hover:rounded-md">Current</a>
                                    <a href="#" class="block px-6 py-3 text-base font-medium text-gray-200 hover:text-white dark:text-gray-200 dark:hover:text-white transition-all duration-200 hover:bg-primary/20 dark:hover:bg-primary/10 hover:rounded-md">Upcoming</a>
                                    <a href="#" class="block px-6 py-3 text-base font-medium text-gray-200 hover:text-white dark:text-gray-200 dark:hover:text-white transition-all duration-200 hover:bg-primary/20 dark:hover:bg-primary/10 hover:rounded-md">Past</a>
                                </div>
                            </div>
                        </div>

                        <div class="relative group">
                            <button class="flex items-center px-4 py-2 text-white transition duration-300">
                                <div class="absolute -left-2 -top-2 h-6 w-6 rounded-full bg-white/20 group-hover:bg-white/30 dark:bg-white/10 dark:group-hover:bg-white/20"></div>
                                <span class="flex items-center gap-2">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                        <polyline points="22 4 12 14 4 4"/>
                                    </svg>
                                    Support
                                    <svg class="h-4 w-4 ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M6 9l6 6 6-6"/>
                                    </svg>
                                </span>
                            </button>
                            <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-gradient-to-r from-primary/10 to-secondary/10 backdrop-blur-md dark:from-primary/5 dark:to-secondary/5 ring-1 ring-primary/20 dark:ring-primary/10 group-hover:opacity-100 opacity-0 transition-opacity duration-300">
                                <div class="py-2">
                                    <a href="#" class="block px-6 py-3 text-base font-medium text-gray-200 hover:text-white dark:text-gray-200 dark:hover:text-white transition-all duration-200 hover:bg-primary/20 dark:hover:bg-primary/10 hover:rounded-md">Help Center</a>
                                    <a href="#" class="block px-6 py-3 text-base font-medium text-gray-200 hover:text-white dark:text-gray-200 dark:hover:text-white transition-all duration-200 hover:bg-primary/20 dark:hover:bg-primary/10 hover:rounded-md">Guides</a>
                                    <a href="#" class="block px-6 py-3 text-base font-medium text-gray-200 hover:text-white dark:text-gray-200 dark:hover:text-white transition-all duration-200 hover:bg-primary/20 dark:hover:bg-primary/10 hover:rounded-md">Contact</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="canLogin" class="flex items-center justify-end space-x-6">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="group relative px-4 py-2 text-white transition duration-300"
                        >
                            <div class="absolute -left-2 -top-2 h-6 w-6 rounded-full bg-white/20 group-hover:bg-white/30 dark:bg-white/10 dark:group-hover:bg-white/20"></div>
                            <div class="flex items-center gap-2">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0-18 0z"/>
                                    <path d="M12 2a7 7 0 1 1 0 14a7 7 0 0 1 0-14z"/>
                                </svg>
                                Dashboard
                            </div>
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="group relative px-4 py-2 text-white transition duration-300"
                            >
                                <div class="absolute -left-2 -top-2 h-6 w-6 rounded-full bg-white/20 group-hover:bg-white/30 dark:bg-white/10 dark:group-hover:bg-white/20"></div>
                                <div class="flex items-center gap-2">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 14c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3z"/>
                                        <path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                    </svg>
                                    Log in
                                </div>
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="group relative px-4 py-2 text-white bg-white/10 rounded-md transition duration-300 hover:bg-white/20 dark:bg-white/5 dark:hover:bg-white/10"
                            >
                                <div class="absolute -left-2 -top-2 h-6 w-6 rounded-full bg-white/20 dark:bg-white/10"></div>
                                <div class="flex items-center gap-2">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 17l10 5 10-5M2 17l10 5 10-5"/>
                                    </svg>
                                    Register
                                </div>
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative pt-24">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <!-- Left Content -->
                    <div class="animate__animated animate__fadeInLeft" :class="{'animate__fadeInLeft': scrollPosition > 0}">
                        <h1 class="text-6xl font-bold text-gray-800 dark:text-white mb-6">
                            Welcome to Pro Clubs
                        </h1>
                        <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 max-w-2xl">
                            Join our community of FIFA 24 Pro Clubs players and compete in official tournaments.
                        </p>
                        <div class="flex space-x-4">
                            <Link
                                :href="route('register')"
                                class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-primary to-secondary rounded-full hover:from-primary/90 hover:to-secondary/90 transition duration-300 dark:from-primary/80 dark:to-secondary/70 dark:hover:from-primary/90 dark:hover:to-secondary/80"
                            >
                                <div class="inline-flex items-center gap-2">
                                    <FontAwesomeIcon :icon="faDiscord" class="w-6 h-6" />
                                    Get Started
                                </div>
                            </Link>
                            <Link
                                :href="route('login')"
                                class="inline-flex items-center px-8 py-4 text-lg font-semibold text-primary bg-white border border-primary rounded-full hover:bg-primary/5 transition duration-300 dark:bg-gray-800 dark:border-primary/80 dark:hover:bg-primary/10"
                            >
                                <div class="inline-flex items-center gap-2">
                                    <FontAwesomeIcon :icon="faTwitch" class="w-6 h-6" />
                                    Learn More
                                </div>
                            </Link>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="animate__animated animate__fadeInRight" :class="{'animate__fadeInRight': scrollPosition > 0}">
                        <div class="relative w-full aspect-video overflow-hidden rounded-lg shadow-2xl mb-8">
                            <img src="https://media.contentapi.ea.com/content/dam/ea/fc/fc-24/common/buy/fc24-pre-order-featured-image-16x9.jpg.adapt.crop16x9.1023w.jpg" alt="FIFA Pro Clubs" class="w-full h-full object-cover rounded-lg">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works Section -->
        <div class="py-20 bg-gray-200 dark:bg-gray-900" :class="{'animate__animated animate__fadeIn': scrollPosition > 400}">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-primary to-secondary rounded-full mb-6 hover:from-primary/90 hover:to-secondary/90 transition duration-300 dark:from-primary/80 dark:to-secondary/70 dark:hover:from-primary/90 dark:hover:to-secondary/80">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm0 2c-6.627 0-12-5.373-12-12S5.373 2 12 2s12 5.373 12 12-5.373 12-12 12zm6.364-11a1 1 0 1 0-1.447.894l.353.353-1.414 1.414-.353-.353a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l2-2a1 1 0 0 0 0-1.414z"/>
                        </svg>
                        <span class="ml-3 text-xl font-bold text-white">How It Works</span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div v-for="(step, index) in howItWorks" :key="index" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 dark:bg-primary/20 mb-4">
                            <FontAwesomeIcon :icon="step.icon" class="w-6 h-6 text-primary dark:text-primary" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                            {{ step.title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ step.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Container -->
        <div class="py-20" :class="{'animate__animated animate__fadeIn': scrollPosition > 600}">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-secondary to-accent rounded-full mb-6 hover:from-secondary/90 hover:to-accent/90 transition duration-300 dark:from-secondary/80 dark:to-accent/70 dark:hover:from-secondary/90 dark:hover:to-accent/80">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm0 2c-6.627 0-12-5.373-12-12S5.373 2 12 2s12 5.373 12 12-5.373 12-12 12zm6.364-11a1 1 0 1 0-1.447.894l.353.353-1.414 1.414-.353-.353a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l2-2a1 1 0 0 0 0-1.414z"/>
                        </svg>
                        <span class="ml-3 text-xl font-bold text-white">Community Stats</span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div v-for="(stat, index) in stats" :key="index" class="stat-card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center">
                        <div class="text-4xl font-bold text-primary dark:text-primary mb-2 stat-number" :data-target="stat.value">
                            0
                        </div>
                        <div class="text-xl font-semibold text-gray-800 dark:text-white">
                            {{ stat.label }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-20" :class="{'animate__animated animate__fadeIn': scrollPosition > 800}">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-secondary to-accent rounded-full mb-6 hover:from-secondary/90 hover:to-accent/90 transition duration-300 dark:from-secondary/80 dark:to-accent/70 dark:hover:from-secondary/90 dark:hover:to-accent/80">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm0 2c-6.627 0-12-5.373-12-12S5.373 2 12 2s12 5.373 12 12-5.373 12-12 12zm6.364-11a1 1 0 1 0-1.447.894l.353.353-1.414 1.414-.353-.353a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l2-2a1 1 0 0 0 0-1.414z"/>
                        </svg>
                        <span class="ml-3 text-xl font-bold text-white">Why Choose Us</span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div v-for="(feature, index) in features" :key="index" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 dark:bg-primary/20 mb-4">
                            <component :is="feature.icon" class="w-6 h-6 text-primary dark:text-primary" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                            {{ feature.title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ feature.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Discord & Twitch Section -->
        <div class="py-20 bg-gray-200 dark:bg-gray-900" :class="{'animate__animated animate__fadeIn': scrollPosition > 1000}">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-accent to-primary rounded-full mb-6 hover:from-accent/90 hover:to-primary/90 transition duration-300 dark:from-accent/80 dark:to-primary/70 dark:hover:from-accent/90 dark:hover:to-primary/80">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm0 2c-6.627 0-12-5.373-12-12S5.373 2 12 2s12 5.373 12 12-5.373 12-12 12zm6.364-11a1 1 0 1 0-1.447.894l.353.353-1.414 1.414-.353-.353a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l2-2a1 1 0 0 0 0-1.414z"/>
                        </svg>
                        <span class="ml-3 text-xl font-bold text-white">Join Our Community</span>
                    </div>
                    <h2 class="text-5xl font-bold text-gray-800 dark:text-white mb-4">
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Discord Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-discord/10 dark:bg-discord/20 mb-4">
                            <FontAwesomeIcon :icon="faDiscord" class="w-6 h-6 text-discord" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                            Discord Community
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Join our active Discord community to connect with other players, get support, and participate in discussions.
                        </p>
                        <Link
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-discord rounded-full hover:bg-discord/90 transition duration-300 dark:hover:bg-discord/80"
                        >
                            <div class="inline-flex items-center gap-2">
                                <FontAwesomeIcon :icon="faDiscord" class="w-4 h-4" />
                                Join Discord
                            </div>
                        </Link>
                    </div>
                    <!-- Twitch Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-twitch/10 dark:bg-twitch/20 mb-4">
                            <FontAwesomeIcon :icon="faTwitch" class="w-6 h-6 text-twitch" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                            Twitch Streamers
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Watch and interact with our community of streamers who showcase Pro Clubs gameplay and strategies.
                        </p>
                        <Link
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-twitch rounded-full hover:bg-twitch/90 transition duration-300 dark:hover:bg-twitch/80"
                        >
                            <div class="inline-flex items-center gap-2">
                                <FontAwesomeIcon :icon="faTwitch" class="w-4 h-4" />
                                Watch Twitch
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold mb-4">About Pro Clubs</h3>
                        <p class="text-gray-400">
                            Join the ultimate FIFA 25 Pro Clubs experience with our community-driven platform.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><Link :href="route('dashboard')" class="text-gray-400 hover:text-white">Dashboard</Link></li>
                            <li><Link :href="route('login')" class="text-gray-400 hover:text-white">Login</Link></li>
                            <li><Link :href="route('register')" class="text-gray-400 hover:text-white">Register</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Legal</h3>
                        <p class="text-gray-400">
                            This website is not affiliated with or sponsored by Electronic Arts Inc. or its licensors.
                            All FIFA elements are property of EA Sports.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<style>
    .stats-container {
        position: relative;
        z-index: 10;
    }

    .stat-card {
        transition: transform 0.3s ease;
        cursor: default;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        margin: 0 auto;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    }

    .stat-number {
        font-family: 'Figtree', sans-serif;
    }
</style>
