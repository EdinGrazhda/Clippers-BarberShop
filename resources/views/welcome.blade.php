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
</head>
<body class="bg-black text-white antialiased font-sans selection:bg-yellow-400 selection:text-black">
    
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

        <!-- Booking Section -->
        <section id="booking" class="py-20 sm:py-24 bg-zinc-950">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl sm:text-5xl font-serif font-bold text-white mb-4" data-animate>Book Your Appointment</h2>
                        <p class="text-xl text-white/70" data-animate>Ready for your next cut? Schedule with us today.</p>
                    </div>

                    <form method="POST" action="{{ route('book') }}" class="bg-white/5 p-8 rounded-2xl border border-white/10" data-animate>
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-white/80 mb-2">Full Name *</label>
                                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                       class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white placeholder-white/40 focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-white/80 mb-2">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}"
                                       class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white placeholder-white/40 focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-white/80 mb-2">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                       class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white placeholder-white/40 focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors">
                            </div>

                            <div>
                                <label for="service" class="block text-sm font-medium text-white/80 mb-2">Service *</label>
                                <select id="service" name="service" required
                                        class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors">
                                    <option value="">Select a service</option>
                                    <option value="Classic Haircut" {{ old('service') == 'Classic Haircut' ? 'selected' : '' }}>Classic Haircut - $35</option>
                                    <option value="Skin Fade" {{ old('service') == 'Skin Fade' ? 'selected' : '' }}>Skin Fade - $45</option>
                                    <option value="Beard Trim" {{ old('service') == 'Beard Trim' ? 'selected' : '' }}>Beard Trim - $25</option>
                                    <option value="Hot Towel Shave" {{ old('service') == 'Hot Towel Shave' ? 'selected' : '' }}>Hot Towel Shave - $40</option>
                                    <option value="The Full Experience" {{ old('service') == 'The Full Experience' ? 'selected' : '' }}>The Full Experience - $85</option>
                                </select>
                            </div>

                            <div>
                                <label for="date" class="block text-sm font-medium text-white/80 mb-2">Preferred Date *</label>
                                <input type="date" id="date" name="date" required value="{{ old('date') }}"
                                       class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors">
                            </div>

                            <div>
                                <label for="time" class="block text-sm font-medium text-white/80 mb-2">Preferred Time *</label>
                                <select id="time" name="time" required
                                        class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors">
                                    <option value="">Select a time</option>
                                    <option value="09:00" {{ old('time') == '09:00' ? 'selected' : '' }}>9:00 AM</option>
                                    <option value="10:00" {{ old('time') == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                                    <option value="11:00" {{ old('time') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                    <option value="12:00" {{ old('time') == '12:00' ? 'selected' : '' }}>12:00 PM</option>
                                    <option value="13:00" {{ old('time') == '13:00' ? 'selected' : '' }}>1:00 PM</option>
                                    <option value="14:00" {{ old('time') == '14:00' ? 'selected' : '' }}>2:00 PM</option>
                                    <option value="15:00" {{ old('time') == '15:00' ? 'selected' : '' }}>3:00 PM</option>
                                    <option value="16:00" {{ old('time') == '16:00' ? 'selected' : '' }}>4:00 PM</option>
                                    <option value="17:00" {{ old('time') == '17:00' ? 'selected' : '' }}>5:00 PM</option>
                                    <option value="18:00" {{ old('time') == '18:00' ? 'selected' : '' }}>6:00 PM</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-white/80 mb-2">Special Requests</label>
                            <textarea id="notes" name="notes" rows="4"
                                      class="w-full px-4 py-3 bg-black/40 border border-white/20 rounded-lg text-white placeholder-white/40 focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition-colors"
                                      placeholder="Any specific requests or preferences?">{{ old('notes') }}</textarea>
                        </div>

                        @if ($errors->any())
                            <div class="mt-6 p-4 bg-red-500/20 border border-red-500/30 rounded-lg">
                                <ul class="text-red-300 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <p class="text-sm text-white/60">We'll confirm your appointment within 24 hours</p>
                            <button type="submit" class="bg-yellow-400 text-black px-8 py-3 rounded-full font-semibold hover:bg-yellow-300 transition-all transform hover:scale-105">
                                Book Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

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
        // Set minimum date to today
        document.getElementById('date').min = new Date().toISOString().split('T')[0];
    </script>
</body>
</html>
