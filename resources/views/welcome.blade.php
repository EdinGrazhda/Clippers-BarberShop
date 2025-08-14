<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Clippers Barbershop - Your Style, Our Craft</title>
    <meta name="description" content="Premium barbershop offering precision cuts, beard trims, and hot towel shaves. Book your appointment today.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-black text-white antialiased font-sans selection:bg-yellow-400 selection:text-black">
    
    <!-- Flash Messages -->
    @if(session('success'))
        <div x-data="{ show: true }" 
             x-init="setTimeout(() => show = false, 5000)" 
             x-show="show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="fixed top-4 right-4 z-[60] w-full max-w-md">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 border border-green-400/30 rounded-xl shadow-2xl backdrop-blur-sm">
                <div class="p-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-bold text-lg mb-1">🎉 Booking Confirmed!</h4>
                            <p class="text-white/90 text-sm leading-relaxed">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="flex-shrink-0 text-white/60 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" 
             x-init="setTimeout(() => show = false, 5000)" 
             x-show="show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="fixed top-4 right-4 z-[60] w-full max-w-md">
            <div class="bg-gradient-to-r from-red-500 to-rose-600 border border-red-400/30 rounded-xl shadow-2xl backdrop-blur-sm">
                <div class="p-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-bold text-lg mb-1">❌ Booking Failed</h4>
                            <p class="text-white/90 text-sm leading-relaxed">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="flex-shrink-0 text-white/60 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div x-data="{ show: true }" 
             x-init="setTimeout(() => show = false, 6000)" 
             x-show="show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="fixed top-4 right-4 z-[60] w-full max-w-md">
            <div class="bg-gradient-to-r from-orange-500 to-amber-600 border border-orange-400/30 rounded-xl shadow-2xl backdrop-blur-sm">
                <div class="p-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.19 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-bold text-lg mb-1">⚠️ Validation Errors</h4>
                            <div class="text-white/90 text-sm space-y-1">
                                @foreach($errors->all() as $error)
                                    <p class="leading-relaxed">• {{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                        <button @click="show = false" class="flex-shrink-0 text-white/60 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Header -->
    <header class="fixed top-0 inset-x-0 z-50 border-b border-white/10 bg-black/80 backdrop-blur-xl">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#hero" class="flex items-center space-x-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 text-black font-bold text-lg">
                            CB
                        </div>
                        <span class="text-xl font-semibold tracking-tight">Clippers</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#services" class="text-sm font-medium text-white/80 hover:text-yellow-400 transition-colors">Services</a>
                    <a href="#pricing" class="text-sm font-medium text-white/80 hover:text-yellow-400 transition-colors">Pricing</a>
                    <a href="#gallery" class="text-sm font-medium text-white/80 hover:text-yellow-400 transition-colors">Gallery</a>
                    <a href="#testimonials" class="text-sm font-medium text-white/80 hover:text-yellow-400 transition-colors">Reviews</a>
                    <a href="#location" class="text-sm font-medium text-white/80 hover:text-yellow-400 transition-colors">Location</a>
                    <a href="#booking" class="bg-yellow-400 text-black px-6 py-2 rounded-full font-semibold hover:bg-yellow-300 transition-colors">
                        Book Now
                    </a>
                </nav>

                <!-- Mobile menu button -->
                <button id="mobileMenuBtn" class="md:hidden p-2 rounded-md text-white/80 hover:text-white hover:bg-white/10 transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobileMenu" class="md:hidden hidden border-t border-white/10 bg-black/90 backdrop-blur-xl">
            <div class="px-4 py-4 space-y-4">
                <a href="#services" class="block text-white/80 hover:text-yellow-400 transition-colors">Services</a>
                <a href="#pricing" class="block text-white/80 hover:text-yellow-400 transition-colors">Pricing</a>
                <a href="#gallery" class="block text-white/80 hover:text-yellow-400 transition-colors">Gallery</a>
                <a href="#testimonials" class="block text-white/80 hover:text-yellow-400 transition-colors">Reviews</a>
                <a href="#location" class="block text-white/80 hover:text-yellow-400 transition-colors">Location</a>
                <a href="#booking" class="block bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold text-center hover:bg-yellow-300 transition-colors">
                    Book Now
                </a>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="hero" class="relative min-h-screen overflow-hidden">
            <!-- Background Slideshow -->
            <div class="absolute inset-0 z-0">
                <div class="hero-slideshow">
                    <img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?q=80&w=2070&auto=format&fit=crop" 
                         alt="Classic barbershop interior" 
                         class="hero-slide active w-full h-full object-cover">
                    <img src="https://images.unsplash.com/photo-1559599189-fe84dea4eb79?q=80&w=2069&auto=format&fit=crop" 
                         alt="Barber cutting hair with precision" 
                         class="hero-slide w-full h-full object-cover">
                    <img src="https://images.unsplash.com/photo-1622287162716-f311baa1a2b8?q=80&w=2070&auto=format&fit=crop" 
                         alt="Professional barbershop tools" 
                         class="hero-slide w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/30"></div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 min-h-screen flex items-center">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="text-left">
                        @if(session('status'))
                            <div class="mb-8 p-4 bg-green-500/20 border border-green-500/30 rounded-xl text-green-300 text-sm" data-animate>
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-400/10 border border-yellow-400/20 rounded-full text-yellow-400 text-sm font-medium mb-6" data-animate>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Premium Barbershop Experience
                        </div>
                        
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-serif font-bold text-white leading-tight mb-6" data-animate>
                            Your Style,<br>
                            <span class="bg-gradient-to-r from-yellow-400 to-yellow-300 bg-clip-text text-transparent">Our Craft</span>
                        </h1>
                        
                        <p class="text-xl sm:text-2xl text-white/80 leading-relaxed mb-8 max-w-2xl" data-animate>
                            Master barbers delivering precision cuts, sculpted beards, and classic hot towel shaves. 
                            Where timeless tradition meets modern excellence.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 mb-12" data-animate>
                            <a href="#booking" class="bg-gradient-to-r from-yellow-400 to-yellow-300 text-black px-8 py-4 rounded-full font-bold text-lg hover:from-yellow-300 hover:to-yellow-200 transition-all transform hover:scale-105 shadow-lg hover:shadow-yellow-400/25">
                                Book Appointment
                            </a>
                            <a href="#services" class="border-2 border-white/30 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white/10 hover:border-white/50 transition-all backdrop-blur-sm">
                                View Services
                            </a>
                        </div>
                        
                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-8" data-animate>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-yellow-400">500+</div>
                                <div class="text-white/60 text-sm">Happy Clients</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-yellow-400">15+</div>
                                <div class="text-white/60 text-sm">Years Experience</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-yellow-400">5★</div>
                                <div class="text-white/60 text-sm">Average Rating</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Content - Feature Images -->
                    <div class="relative lg:h-[600px]" data-animate>
                        <div class="grid grid-cols-2 gap-4 h-full">
                            <div class="space-y-4">
                                <div class="relative overflow-hidden rounded-2xl border border-white/10 h-64">
                                    <img src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=1000&auto=format&fit=crop" 
                                         alt="Professional beard trim" 
                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4">
                                        <div class="text-white font-semibold">Beard Sculpting</div>
                                        <div class="text-white/70 text-sm">Precision trimming</div>
                                    </div>
                                </div>
                                <div class="relative overflow-hidden rounded-2xl border border-white/10 h-44">
                                    <img src="https://images.unsplash.com/photo-1621605815971-fbc98d665033?q=80&w=1000&auto=format&fit=crop" 
                                         alt="Classic shave tools" 
                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4">
                                        <div class="text-white font-semibold">Classic Tools</div>
                                        <div class="text-white/70 text-sm">Traditional craft</div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4 mt-8">
                                <div class="relative overflow-hidden rounded-2xl border border-white/10 h-44">
                                    <img src="https://images.unsplash.com/photo-1622902046580-2b47f47f5471?q=80&w=1000&auto=format&fit=crop" 
                                         alt="Hair styling" 
                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4">
                                        <div class="text-white font-semibold">Style Finishing</div>
                                        <div class="text-white/70 text-sm">Perfect details</div>
                                    </div>
                                </div>
                                <div class="relative overflow-hidden rounded-2xl border border-white/10 h-64">
                                    <img src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?q=80&w=1000&auto=format&fit=crop" 
                                         alt="Modern barbershop" 
                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4">
                                        <div class="text-white font-semibold">Modern Comfort</div>
                                        <div class="text-white/70 text-sm">Luxury experience</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Elements -->
                        <div class="absolute -top-4 -right-4 w-20 h-20 bg-yellow-400/20 rounded-full blur-xl"></div>
                        <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-yellow-400/10 rounded-full blur-2xl"></div>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce z-20">
                <div class="flex flex-col items-center gap-2">
                    <span class="text-white/60 text-xs font-medium">Scroll to explore</span>
                    <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="py-20 sm:py-24 bg-zinc-950">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl sm:text-5xl font-serif font-bold text-white mb-4" data-animate>Our Services</h2>
                    <p class="text-xl text-white/70" data-animate>Crafted with precision, delivered with excellence</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Haircut -->
                    <div class="group p-8 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300" data-animate>
                        <div class="w-16 h-16 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-400/30 transition-colors">
                            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-white mb-3">Precision Haircuts</h3>
                        <p class="text-white/70 leading-relaxed">Modern cuts and classic styles tailored to your face shape and lifestyle. From fades to scissor cuts, we perfect every detail.</p>
                    </div>

                    <!-- Beard Trim -->
                    <div class="group p-8 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300" data-animate>
                        <div class="w-16 h-16 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-400/30 transition-colors">
                            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-white mb-3">Beard Sculpting</h3>
                        <p class="text-white/70 leading-relaxed">Professional beard trimming and shaping. We'll craft the perfect beard style that complements your features and personal style.</p>
                    </div>

                    <!-- Hot Towel Shave -->
                    <div class="group p-8 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300" data-animate>
                        <div class="w-16 h-16 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-400/30 transition-colors">
                            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-white mb-3">Hot Towel Shave</h3>
                        <p class="text-white/70 leading-relaxed">Experience the luxury of a traditional straight razor shave with hot towel treatment. The ultimate in relaxation and precision.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section id="pricing" class="py-20 sm:py-24 bg-black">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl sm:text-5xl font-serif font-bold text-white mb-4" data-animate>Pricing</h2>
                    <p class="text-xl text-white/70" data-animate>Transparent pricing for premium services</p>
                </div>

                <div class="max-w-4xl mx-auto">
                    <div class="bg-white/5 rounded-2xl border border-white/10 overflow-hidden">
                        <!-- Haircut Services -->
                        <div class="p-6 border-b border-white/10">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Classic Haircut</h3>
                                    <p class="text-white/60">Consultation, wash, cut & style</p>
                                </div>
                                <span class="text-2xl font-bold text-yellow-400">$35</span>
                            </div>
                        </div>

                        <div class="p-6 border-b border-white/10">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Skin Fade</h3>
                                    <p class="text-white/60">Precision fade with detailed finishing</p>
                                </div>
                                <span class="text-2xl font-bold text-yellow-400">$45</span>
                            </div>
                        </div>

                        <div class="p-6 border-b border-white/10">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Beard Trim</h3>
                                    <p class="text-white/60">Shape, trim & conditioning treatment</p>
                                </div>
                                <span class="text-2xl font-bold text-yellow-400">$25</span>
                            </div>
                        </div>

                        <div class="p-6 border-b border-white/10">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Hot Towel Shave</h3>
                                    <p class="text-white/60">Traditional straight razor experience</p>
                                </div>
                                <span class="text-2xl font-bold text-yellow-400">$40</span>
                            </div>
                        </div>

                        <div class="p-6 bg-yellow-400/10">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-xl font-semibold text-white">The Full Experience</h3>
                                    <p class="text-white/60">Cut, beard trim & hot towel shave</p>
                                </div>
                                <span class="text-2xl font-bold text-yellow-400">$85</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section id="gallery" class="py-20 sm:py-24 bg-zinc-950">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl sm:text-5xl font-serif font-bold text-white mb-4" data-animate>Gallery</h2>
                    <p class="text-xl text-white/70" data-animate>Step inside our modern barbershop</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="relative group overflow-hidden rounded-xl" data-animate>
                        <img src="https://images.unsplash.com/photo-1521490878406-4b4f93b0f305?q=80&w=800&auto=format&fit=crop" 
                             alt="Barbershop interior" 
                             class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <div class="relative group overflow-hidden rounded-xl" data-animate>
                        <img src="https://images.unsplash.com/photo-1566492031773-4f4e44671d66?q=80&w=800&auto=format&fit=crop" 
                             alt="Barber tools" 
                             class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <div class="relative group overflow-hidden rounded-xl" data-animate>
                        <img src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=800&auto=format&fit=crop" 
                             alt="Professional haircut" 
                             class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <div class="relative group overflow-hidden rounded-xl" data-animate>
                        <img src="https://images.unsplash.com/photo-1605980676506-4903781c9347?q=80&w=800&auto=format&fit=crop" 
                             alt="Beard trimming" 
                             class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <div class="relative group overflow-hidden rounded-xl" data-animate>
                        <img src="https://images.unsplash.com/photo-1522337660859-02fbefca4702?q=80&w=800&auto=format&fit=crop" 
                             alt="Classic shave" 
                             class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <div class="relative group overflow-hidden rounded-xl" data-animate>
                        <img src="https://images.unsplash.com/photo-1559599101-f09722fb4948?q=80&w=800&auto=format&fit=crop" 
                             alt="Barbershop atmosphere" 
                             class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="py-20 sm:py-24 bg-black">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl sm:text-5xl font-serif font-bold text-white mb-4" data-animate>What Our Clients Say</h2>
                    <p class="text-xl text-white/70" data-animate>Real reviews from satisfied customers</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white/5 p-8 rounded-2xl border border-white/10" data-animate>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </div>
                        </div>
                        <p class="text-white/80 mb-6 leading-relaxed">"Best barbershop in the city! The attention to detail is incredible and the atmosphere is perfect. My fade has never looked better."</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center text-black font-semibold mr-4">MJ</div>
                            <div>
                                <p class="text-white font-semibold">Marcus Johnson</p>
                                <p class="text-white/60 text-sm">Regular Client</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 p-8 rounded-2xl border border-white/10" data-animate>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </div>
                        </div>
                        <p class="text-white/80 mb-6 leading-relaxed">"The hot towel shave is an experience like no other. Professional, relaxing, and the results are amazing. Highly recommend!"</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center text-black font-semibold mr-4">DR</div>
                            <div>
                                <p class="text-white font-semibold">David Rodriguez</p>
                                <p class="text-white/60 text-sm">Business Executive</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 p-8 rounded-2xl border border-white/10" data-animate>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </div>
                        </div>
                        <p class="text-white/80 mb-6 leading-relaxed">"Consistently excellent service and quality. The team really knows their craft and creates a welcoming atmosphere. My go-to spot!"</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center text-black font-semibold mr-4">AT</div>
                            <div>
                                <p class="text-white font-semibold">Alex Thompson</p>
                                <p class="text-white/60 text-sm">Local Artist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Appointment Section -->
        <section id="booking" class="py-20 sm:py-24 bg-zinc-950">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl sm:text-5xl font-serif font-bold text-white mb-4" data-animate>Meet Our Barbers</h2>
                    <p class="text-xl text-white/70" data-animate>Choose your preferred barber and book your appointment.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($barbers as $barber)
                    <div class="bg-white/5 rounded-2xl border border-white/10 overflow-hidden group hover:bg-white/10 transition-all duration-300" data-animate>
                        <div class="aspect-w-4 aspect-h-3 relative">
                            @if($barber->image)
                                <img src="{{ Storage::url($barber->image) }}" 
                                     alt="{{ $barber->name }}" 
                                     class="w-full h-64 object-cover">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-yellow-400/20 to-yellow-600/20 flex items-center justify-center">
                                    <div class="w-24 h-24 bg-yellow-400 rounded-full flex items-center justify-center text-black text-2xl font-bold">
                                        {{ substr($barber->name, 0, 1) }}
                                    </div>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-white mb-2">{{ $barber->name }}</h3>
                            
                            @if($barber->experience_years)
                                <p class="text-yellow-400 mb-2">{{ $barber->experience_years }} years experience</p>
                            @endif
                            
                            @if($barber->description)
                                <p class="text-white/70 mb-4 line-clamp-3">{{ $barber->description }}</p>
                            @endif
                            
                            @if($barber->specialties && count($barber->specialties) > 0)
                                <div class="mb-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(array_slice($barber->specialties, 0, 3) as $specialty)
                                            <span class="px-2 py-1 text-xs bg-yellow-400/20 text-yellow-400 rounded-full">
                                                {{ $specialty }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <button onclick="document.dispatchEvent(new CustomEvent('open-booking-modal', { detail: { barberId: {{ $barber->id }}, barberName: '{{ $barber->name }}' } }))"
                                    class="w-full bg-yellow-400 text-black px-6 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition-colors">
                                Book with {{ $barber->name }}
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Booking Modal -->
        <div x-data="bookingModal()" 
             x-show="isOpen" 
             x-cloak 
             class="fixed inset-0 z-50 overflow-y-auto bg-black/80 backdrop-blur-sm" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="flex min-h-full items-center justify-center p-4" @click.self="closeModal()">
                <div class="bg-zinc-900 rounded-2xl border border-white/20 p-8 w-full max-w-4xl"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 x-text="modalTitle" class="text-2xl font-bold text-white">Book Appointment</h3>
                            <div class="flex items-center mt-2 space-x-2">
                                <div class="flex items-center">
                                    <div :class="currentStep === 1 ? 'bg-yellow-400 text-black' : (currentStep > 1 ? 'bg-green-500 text-white' : 'bg-white/20 text-white/60')" 
                                         class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                                        <span x-show="currentStep === 1">1</span>
                                        <span x-show="currentStep > 1">✓</span>
                                    </div>
                                    <span :class="currentStep === 1 ? 'text-white' : 'text-white/60'" class="ml-2 text-sm">Client Info</span>
                                </div>
                                <div class="w-6 h-0.5 bg-white/20"></div>
                                <div class="flex items-center">
                                    <div :class="currentStep === 2 ? 'bg-yellow-400 text-black' : (currentStep > 2 ? 'bg-green-500 text-white' : 'bg-white/20 text-white/60')" 
                                         class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                                        <span x-show="currentStep === 2">2</span>
                                        <span x-show="currentStep > 2">✓</span>
                                        <span x-show="currentStep < 2">2</span>
                                    </div>
                                    <span :class="currentStep === 2 ? 'text-white' : 'text-white/60'" class="ml-2 text-sm">Date & Time</span>
                                </div>
                                <div class="w-6 h-0.5 bg-white/20"></div>
                                <div class="flex items-center">
                                    <div :class="currentStep === 3 ? 'bg-yellow-400 text-black' : (currentStep > 3 ? 'bg-green-500 text-white' : 'bg-white/20 text-white/60')" 
                                         class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                                        <span x-show="currentStep === 3">3</span>
                                        <span x-show="currentStep > 3">✓</span>
                                        <span x-show="currentStep < 3">3</span>
                                    </div>
                                    <span :class="currentStep === 3 ? 'text-white' : 'text-white/60'" class="ml-2 text-sm">Verification</span>
                                </div>
                            </div>
                        </div>
                        <button @click="closeModal()" class="text-white/60 hover:text-white text-2xl">×</button>
                    </div>

                    @if(session('success'))
                        <div x-data="{ show: true }" 
                             x-init="setTimeout(() => show = false, 4000)" 
                             x-show="show" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="mb-6 p-6 bg-gradient-to-r from-green-500/20 to-emerald-500/20 border border-green-500/30 rounded-xl shadow-lg">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-green-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-green-300 font-semibold mb-1 text-lg">🎉 Booking Confirmed!</h4>
                                    <p class="text-green-300 text-sm leading-relaxed">{{ session('success') }}</p>
                                </div>
                                <button @click="show = false" class="flex-shrink-0 text-green-300/60 hover:text-green-300 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div x-data="{ show: true }" 
                             x-init="setTimeout(() => show = false, 6000)" 
                             x-show="show" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="mb-6 p-6 bg-gradient-to-r from-red-500/20 to-rose-500/20 border border-red-500/30 rounded-xl shadow-lg">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-red-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.19 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-red-300 font-semibold mb-2 text-lg">⚠️ Please Fix These Issues:</h4>
                                    <div class="text-red-300 text-sm space-y-1">
                                        @foreach($errors->all() as $error)
                                            <p class="leading-relaxed">• {{ $error }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <button @click="show = false" class="flex-shrink-0 text-red-300/60 hover:text-red-300 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('book') }}" @submit.prevent="handleSubmit">
                        @csrf
                        <input type="hidden" name="barber_id" x-model="selectedBarberId">
                        <input type="hidden" name="appointment_date" x-model="appointmentDate">
                        <input type="hidden" name="appointment_time" x-model="selectedTimeSlot">
                        <input type="hidden" name="verification_code" x-model="verificationCode">

                        <!-- Step 1: Client Information & Services -->
                        <div x-show="currentStep === 1" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-x-4"
                             x-transition:enter-end="opacity-100 transform translate-x-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform translate-x-0"
                             x-transition:leave-end="opacity-0 transform -translate-x-4"
                             class="space-y-6">
                            
                            <!-- Client Information -->
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-4">Client Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="customer_name" class="block text-sm font-medium text-white/80 mb-2">Full Name *</label>
                                        <input type="text" id="customer_name" name="customer_name" required x-model="customerName"
                                               class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white placeholder-white/40 focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors">
                                    </div>

                                    <div>
                                        <label for="customer_phone" class="block text-sm font-medium text-white/80 mb-2">Phone Number *</label>
                                        <input type="tel" id="customer_phone" name="customer_phone" required x-model="customerPhone"
                                               class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white placeholder-white/40 focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors">
                                    </div>

                                    <div class="md:col-span-2">
                                        <label for="customer_email" class="block text-sm font-medium text-white/80 mb-2">Email Address *</label>
                                        <input type="email" id="customer_email" name="customer_email" required x-model="customerEmail"
                                               class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white placeholder-white/40 focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors">
                                        <p class="text-sm text-white/60 mt-1">We'll send a verification code to this email</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Services Selection -->
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-4">Select Services *</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @php
                                        $services = [
                                            ['name' => 'Basic Haircut', 'price' => 25],
                                            ['name' => 'Beard Trim', 'price' => 15],
                                            ['name' => 'Hair Wash & Style', 'price' => 20],
                                            ['name' => 'Premium Cut & Styling', 'price' => 45],
                                            ['name' => 'Hot Towel Shave', 'price' => 30],
                                            ['name' => 'Full Grooming Package', 'price' => 65]
                                        ]
                                    @endphp
                                    
                                    @foreach($services as $service)
                                        <label class="flex items-center p-4 bg-black/40 border border-white/20 rounded-lg hover:bg-black/60 transition-colors cursor-pointer">
                                            <input type="checkbox" name="services[]" value="{{ $service['name'] }}" 
                                                   x-model="selectedServices"
                                                   @change="updateTotalPrice()"
                                                   class="w-5 h-5 text-yellow-400 bg-transparent border-white/20 rounded focus:ring-yellow-400 focus:ring-2">
                                            <div class="ml-3 flex-1">
                                                <div class="text-white font-medium">{{ $service['name'] }}</div>
                                                <div class="text-yellow-400 text-sm">${{ $service['price'] }}</div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                <div x-show="showServiceError" class="text-red-400 text-sm mt-2">Please select at least one service.</div>
                            </div>

                            <!-- Total Price -->
                            <div class="bg-black/40 rounded-lg p-4 border border-white/20">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-white">Total Price:</span>
                                    <span class="text-xl font-bold text-yellow-400" x-text="'$' + totalPrice">$0</span>
                                </div>
                            </div>

                            <!-- Step 1 Actions -->
                            <div class="flex justify-between items-center pt-4">
                                <button type="button" @click="closeModal()" 
                                        class="px-6 py-3 border border-white/20 text-white rounded-lg hover:bg-white/10 transition-colors">
                                    Cancel
                                </button>
                                <button type="button" @click="goToStep2()" 
                                        class="px-8 py-3 bg-yellow-400 text-black rounded-lg font-semibold hover:bg-yellow-300 transition-colors">
                                    Next: Choose Date & Time
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Date & Time Selection -->
                        <div x-show="currentStep === 2" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-x-4"
                             x-transition:enter-end="opacity-100 transform translate-x-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform translate-x-0"
                             x-transition:leave-end="opacity-0 transform -translate-x-4"
                             class="space-y-6">
                            
                            <!-- Date Selection -->
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-4">Select Date</h4>
                                <input type="date" id="appointment_date" name="appointment_date" required 
                                       x-model="appointmentDate"
                                       @change="loadAvailableSlots()"
                                       :min="minDate"
                                       class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors">
                            </div>

                            <!-- Time Selection -->
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-4">Available Time Slots</h4>
                                <div x-show="loadingSlots" class="text-center py-8 text-white/60">
                                    Loading available slots...
                                </div>
                                <div x-show="!loadingSlots && availableSlots.length === 0 && appointmentDate" class="text-center py-8 text-red-400">
                                    No available slots for this date
                                </div>
                                <div x-show="!loadingSlots && !appointmentDate" class="text-center py-8 text-white/60">
                                    Please select a date first
                                </div>
                                <div x-show="!loadingSlots && availableSlots.length > 0" class="grid grid-cols-3 md:grid-cols-4 gap-3">
                                    <template x-for="slot in availableSlots" :key="slot">
                                        <button type="button" 
                                                @click="selectTimeSlot(slot)"
                                                :class="selectedTimeSlot === slot ? 'bg-yellow-400 text-black' : 'bg-black/40 border-white/20 text-white hover:bg-white/10'"
                                                class="px-4 py-3 border rounded-lg transition-colors text-sm font-medium"
                                                x-text="formatTime(slot)">
                                        </button>
                                    </template>
                                </div>
                                <div x-show="showTimeSlotError" class="text-red-400 text-sm mt-2">Please select a time slot.</div>
                            </div>

                            <!-- Step 2 Actions -->
                            <div class="flex justify-between items-center pt-4">
                                <button type="button" @click="goToStep1()" 
                                        class="px-6 py-3 border border-white/20 text-white rounded-lg hover:bg-white/10 transition-colors">
                                    Back
                                </button>
                                <div class="flex gap-4">
                                    <button type="button" @click="closeModal()" 
                                            class="px-6 py-3 border border-white/20 text-white rounded-lg hover:bg-white/10 transition-colors">
                                        Cancel
                                    </button>
                                    <button type="button" @click="goToStep3()"
                                            :disabled="!appointmentDate || !selectedTimeSlot"
                                            class="px-8 py-3 bg-yellow-400 text-black rounded-lg font-semibold hover:bg-yellow-300 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                        Next: Verify Email
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Email Verification -->
                        <div x-show="currentStep === 3" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-x-4"
                             x-transition:enter-end="opacity-100 transform translate-x-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform translate-x-0"
                             x-transition:leave-end="opacity-0 transform -translate-x-4"
                             class="space-y-6">
                            
                            <!-- Email Verification -->
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-4">📧 Email Verification</h4>
                                <div class="bg-black/40 rounded-lg p-6 border border-white/20">
                                    <div x-show="!verificationSent">
                                        <p class="text-white/80 mb-4">
                                            We'll send a 4-digit verification code to <strong x-text="customerEmail" class="text-yellow-400"></strong> to confirm your appointment.
                                        </p>
                                        <button type="button" @click="sendVerificationCode()" 
                                                :disabled="sendingCode"
                                                class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                            <span x-show="!sendingCode">📧 Send Verification Code</span>
                                            <span x-show="sendingCode" class="flex items-center justify-center">
                                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                Sending Code...
                                            </span>
                                        </button>
                                    </div>

                                    <div x-show="verificationSent">
                                        <div class="text-center mb-6">
                                            <div class="text-green-400 text-lg font-semibold mb-2">✅ Code Sent!</div>
                                            <p class="text-white/80">
                                                A 4-digit verification code has been sent to <strong x-text="customerEmail" class="text-yellow-400"></strong>
                                            </p>
                                            <p class="text-white/60 text-sm mt-2">Please check your email and enter the code below.</p>
                                        </div>

                                        <div class="space-y-4">
                                            <div>
                                                <label for="verification_code" class="block text-sm font-medium text-white/80 mb-2">Verification Code *</label>
                                                <input type="text" 
                                                       name="verification_code"
                                                       x-model="verificationCode"
                                                       @input="verificationCode = verificationCode.replace(/[^0-9]/g, '').slice(0, 4); showVerificationError = false;"
                                                       placeholder="Enter 4-digit code"
                                                       maxlength="4"
                                                       class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white text-center text-2xl font-bold letter-spacing-4 placeholder-white/40 focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors"
                                                       :class="showVerificationError ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-white/20 focus:border-yellow-400 focus:ring-yellow-400'">
                                            </div>
                                            
                                            <div x-show="showVerificationError" class="text-red-400 text-sm">
                                                <span x-show="!verificationCode">Please enter the verification code.</span>
                                                <span x-show="verificationCode && verificationCode.length !== 4">Verification code must be 4 digits.</span>
                                            </div>
                                            
                                            <div class="flex justify-between items-center text-sm">
                                                <button type="button" @click="sendVerificationCode()" 
                                                        :disabled="sendingCode"
                                                        class="text-blue-400 hover:text-blue-300 transition-colors disabled:opacity-50">
                                                    <span x-show="!sendingCode">📧 Resend Code</span>
                                                    <span x-show="sendingCode">Sending...</span>
                                                </button>
                                                <span class="text-white/60">Code expires in 10 minutes</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3 Actions -->
                            <div class="flex justify-between items-center pt-4">
                                <button type="button" @click="goToStep2()" 
                                        class="px-6 py-3 border border-white/20 text-white rounded-lg hover:bg-white/10 transition-colors">
                                    Back
                                </button>
                                <div class="flex gap-4">
                                    <button type="button" @click="closeModal()" 
                                            class="px-6 py-3 border border-white/20 text-white rounded-lg hover:bg-white/10 transition-colors">
                                        Cancel
                                    </button>
                                    <button type="button" @click="submitBooking()"
                                            :disabled="!verificationSent || verificationCode.length !== 4 || submitting"
                                            class="px-8 py-3 bg-yellow-400 text-black rounded-lg font-semibold hover:bg-yellow-300 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span x-show="!submitting">✅ Confirm Appointment</span>
                                        <span x-show="submitting" class="flex items-center">
                                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Verifying & Booking...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>

        <!-- Location Section -->
        <section id="location" class="py-20 sm:py-24 bg-black">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div data-animate>
                        <h2 class="text-4xl sm:text-5xl font-serif font-bold text-white mb-6">Visit Our Shop</h2>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-yellow-400 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <h3 class="text-xl font-semibold text-white mb-1">Address</h3>
                                    <p class="text-white/70">123 Main Street<br>Downtown District<br>Your City, State 12345</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-yellow-400 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <h3 class="text-xl font-semibold text-white mb-1">Hours</h3>
                                    <div class="text-white/70 space-y-1">
                                        <p>Monday - Friday: 9:00 AM - 7:00 PM</p>
                                        <p>Saturday: 8:00 AM - 6:00 PM</p>
                                        <p>Sunday: 10:00 AM - 4:00 PM</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-yellow-400 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <div>
                                    <h3 class="text-xl font-semibold text-white mb-1">Contact</h3>
                                    <p class="text-white/70">Phone: (555) 123-4567<br>Email: info@clippersbarber.com</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <a href="#booking" class="inline-flex items-center bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold hover:bg-yellow-300 transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Book Now
                            </a>
                        </div>
                    </div>

                    <div class="relative" data-animate>
                        <div class="aspect-w-16 aspect-h-12 rounded-2xl overflow-hidden border border-white/10">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3048.4037836!2d-74.0059!3d40.7614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQ1JzQxLjAiTiA3NMKwMDAnMjEuMyJX!5e0!3m2!1sen!2sus!4v1635959811214!5m2!1sen!2sus" 
                                   width="100%" 
                                   height="400" 
                                   style="border:0;" 
                                   allowfullscreen="" 
                                   loading="lazy" 
                                   referrerpolicy="no-referrer-when-downgrade"
                                   class="w-full h-full object-cover">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-950 border-t border-white/10 py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 text-black font-bold text-lg">
                            CB
                        </div>
                        <span class="text-2xl font-semibold tracking-tight text-white">Clippers</span>
                    </div>
                    <p class="text-white/60 max-w-md leading-relaxed">
                        Where tradition meets modern excellence. Your style is our craft, and we're dedicated to making you look and feel your absolute best.
                    </p>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-white/60">
                        <li><a href="#services" class="hover:text-yellow-400 transition-colors">Services</a></li>
                        <li><a href="#pricing" class="hover:text-yellow-400 transition-colors">Pricing</a></li>
                        <li><a href="#gallery" class="hover:text-yellow-400 transition-colors">Gallery</a></li>
                        <li><a href="#booking" class="hover:text-yellow-400 transition-colors">Book Now</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Contact Info</h3>
                    <ul class="space-y-2 text-white/60">
                        <li>(555) 123-4567</li>
                        <li>info@clippersbarber.com</li>
                        <li>123 Main Street<br>Your City, State 12345</li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-white/40 text-sm">© 2025 Clippers Barbershop. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 sm:mt-0">
                    <a href="#" class="text-white/40 hover:text-yellow-400 transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-white/40 hover:text-yellow-400 transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.328-1.297C4.198 14.97 3.708 13.819 3.708 12.522s.49-2.448 1.297-3.328c.88-.88 2.031-1.297 3.328-1.297s2.448.49 3.328 1.297c.88.88 1.297 2.031 1.297 3.328s-.49 2.448-1.297 3.328c-.88.807-2.031 1.297-3.328 1.297z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Alpine.js booking modal component
        function bookingModal() {
            return {
                isOpen: false,
                currentStep: 1,
                selectedBarberId: null,
                selectedBarberName: '',
                // Step 1: Client Information
                customerName: '',
                customerPhone: '',
                customerEmail: '',
                selectedServices: [],
                totalPrice: 0,
                // Step 2: Date & Time
                appointmentDate: '',
                selectedTimeSlot: '',
                availableSlots: [],
                loadingSlots: false,
                showServiceError: false,
                showTimeSlotError: false,
                // Step 3: Email Verification
                verificationCode: '',
                verificationSent: false,
                sendingCode: false,
                showVerificationError: false,
                submitting: false,
                minDate: new Date().toISOString().split('T')[0],
                
                services: {
                    'Basic Haircut': 25,
                    'Beard Trim': 15,
                    'Hair Wash & Style': 20,
                    'Premium Cut & Styling': 45,
                    'Hot Towel Shave': 30,
                    'Full Grooming Package': 65
                },

                get modalTitle() {
                    const steps = ['Client Info & Services', 'Date & Time', 'Email Verification'];
                    const stepTitle = steps[this.currentStep - 1] || 'Book Appointment';
                    return this.selectedBarberName ? `${stepTitle} - ${this.selectedBarberName}` : stepTitle;
                },

                init() {
                    // Ensure modal starts closed
                    this.isOpen = false;
                    this.currentStep = 1;
                    
                    this.$watch('isOpen', (value) => {
                        if (value) {
                            document.body.style.overflow = 'hidden';
                        } else {
                            document.body.style.overflow = '';
                        }
                    });

                    // Listen for barber selection event from the entire document
                    document.addEventListener('open-booking-modal', (event) => {
                        this.openModal(event.detail.barberId, event.detail.barberName);
                    });
                },

                openModal(barberId, barberName) {
                    this.selectedBarberId = barberId;
                    this.selectedBarberName = barberName;
                    this.isOpen = true;
                    this.resetForm();
                },

                closeModal() {
                    this.isOpen = false;
                    this.currentStep = 1;
                    this.resetForm();
                },

                resetForm() {
                    // Step 1: Client Information
                    this.customerName = '';
                    this.customerPhone = '';
                    this.customerEmail = '';
                    this.selectedServices = [];
                    this.totalPrice = 0;
                    // Step 2: Date & Time
                    this.appointmentDate = '';
                    this.selectedTimeSlot = '';
                    this.availableSlots = [];
                    this.showServiceError = false;
                    this.showTimeSlotError = false;
                    // Step 3: Email Verification
                    this.verificationCode = '';
                    this.verificationSent = false;
                    this.sendingCode = false;
                    this.showVerificationError = false;
                    this.submitting = false;
                },

                submitBooking() {
                    // Validate final step - including verification code
                    if (!this.appointmentDate || !this.selectedTimeSlot || !this.verificationCode || this.verificationCode.length !== 4) {
                        if (!this.appointmentDate || !this.selectedTimeSlot) {
                            this.showTimeSlotError = true;
                        }
                        if (!this.verificationCode || this.verificationCode.length !== 4) {
                            this.showVerificationError = true;
                        }
                        return;
                    }
                    
                    this.showTimeSlotError = false;
                    this.showVerificationError = false;
                    this.submitting = true;

                    // Create and submit form programmatically
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/book';

                    // Add CSRF token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.appendChild(csrfInput);

                    // Add form data - INCLUDING verification_code
                    const formData = {
                        barber_id: this.selectedBarberId,
                        customer_name: this.customerName,
                        customer_phone: this.customerPhone,
                        customer_email: this.customerEmail,
                        appointment_date: this.appointmentDate,
                        appointment_time: this.selectedTimeSlot,
                        verification_code: this.verificationCode,
                        services: this.selectedServices
                    };

                    console.log('Submitting form data:', formData); // Debug log

                    Object.entries(formData).forEach(([key, value]) => {
                        if (key === 'services') {
                            // Handle services array by creating multiple inputs
                            value.forEach(service => {
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'services[]';
                                input.value = service;
                                form.appendChild(input);
                            });
                        } else {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = key;
                            input.value = value;
                            form.appendChild(input);
                        }
                    });

                    document.body.appendChild(form);
                    form.submit();
                },

                updateTotalPrice() {
                    this.totalPrice = this.selectedServices.reduce((total, service) => {
                        return total + (this.services[service] || 0);
                    }, 0);
                },

                goToStep2() {
                    // Validate step 1
                    if (!this.customerName.trim() || !this.customerPhone.trim() || !this.customerEmail.trim() || this.selectedServices.length === 0) {
                        if (this.selectedServices.length === 0) {
                            this.showServiceError = true;
                        }
                        return;
                    }
                    
                    this.showServiceError = false;
                    this.currentStep = 2;
                },

                goToStep1() {
                    this.currentStep = 1;
                },

                goToStep3() {
                    // Validate step 2
                    if (!this.appointmentDate || !this.selectedTimeSlot) {
                        this.showTimeSlotError = true;
                        return;
                    }
                    
                    this.showTimeSlotError = false;
                    this.currentStep = 3;
                },

                goToStep2() {
                    this.currentStep = 2;
                },

                async loadAvailableSlots() {
                    if (!this.appointmentDate) return;
                    
                    this.loadingSlots = true;
                    this.availableSlots = [];
                    this.selectedTimeSlot = '';
                    
                    try {
                        const response = await fetch(`/available-slots?date=${this.appointmentDate}&barber_id=${this.selectedBarberId}`);
                        const data = await response.json();
                        this.availableSlots = data.available_slots || [];
                    } catch (error) {
                        console.error('Error loading slots:', error);
                        this.availableSlots = [];
                    }
                    
                    this.loadingSlots = false;
                },

                selectTimeSlot(slot) {
                    this.selectedTimeSlot = slot;
                    this.showTimeSlotError = false;
                },

                formatTime(timeSlot) {
                    if (!timeSlot) return '';
                    const [hours, minutes] = timeSlot.split(':');
                    const hour = parseInt(hours);
                    const ampm = hour >= 12 ? 'PM' : 'AM';
                    const displayHour = hour > 12 ? hour - 12 : (hour === 0 ? 12 : hour);
                    return `${displayHour}:${minutes} ${ampm}`;
                },

                async sendVerificationCode() {
                    console.log('sendVerificationCode called');
                    console.log('Email:', this.customerEmail);
                    console.log('Name:', this.customerName);
                    
                    if (!this.customerEmail || !this.customerName) {
                        console.log('Missing email or name');
                        this.showTemporaryMessage('❌ Please fill in your name and email first.', 'error');
                        return;
                    }

                    this.sendingCode = true;
                    this.showVerificationError = false;

                    try {
                        console.log('Sending verification request...');
                        const response = await fetch('/send-verification', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                customer_email: this.customerEmail,
                                customer_name: this.customerName
                            })
                        });

                        console.log('Response status:', response.status);
                        const data = await response.json();
                        console.log('Response data:', data);

                        if (data.success) {
                            this.verificationSent = true;
                            this.showTemporaryMessage('✅ Verification code sent to your email!', 'success');
                        } else {
                            throw new Error(data.message || 'Failed to send verification code');
                        }
                    } catch (error) {
                        console.error('Error sending verification code:', error);
                        this.showTemporaryMessage('❌ Failed to send verification code. Please try again.', 'error');
                    } finally {
                        this.sendingCode = false;
                    }
                },

                showTemporaryMessage(message, type = 'success') {
                    // Create a temporary notification
                    const notification = document.createElement('div');
                    notification.className = `fixed top-20 right-4 z-[70] p-4 rounded-lg shadow-lg transform transition-all duration-300 ${
                        type === 'success' ? 'bg-green-600' : 'bg-red-600'
                    } text-white`;
                    notification.textContent = message;
                    
                    document.body.appendChild(notification);
                    
                    // Animate in
                    requestAnimationFrame(() => {
                        notification.style.transform = 'translateX(0)';
                    });
                    
                    // Remove after 3 seconds
                    setTimeout(() => {
                        notification.style.transform = 'translateX(100%)';
                        setTimeout(() => {
                            document.body.removeChild(notification);
                        }, 300);
                    }, 3000);
                },

                formatDate(dateString) {
                    if (!dateString) return '';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('en-US', { 
                        weekday: 'long', 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    });
                },

                handleSubmit(event) {
                    // Prevent default form submission since we handle it with JavaScript
                    event.preventDefault();
                    return false;
                }
            }
        }

        // Page animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Initialize animations
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('[data-animate]');
            animatedElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });

            // Smooth scroll for navigation links
            const navLinks = document.querySelectorAll('a[href^="#"]');
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = link.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
