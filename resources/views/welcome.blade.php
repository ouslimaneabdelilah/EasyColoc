<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EasyColoc') }} - Shared Living Simplified</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="antialiased bg-slate-50 text-slate-900 selection:bg-primary/20 overflow-x-hidden">

    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-primary/10 rounded-full blur-[120px] animate-blob"></div>
        <div class="absolute top-[20%] -right-[5%] w-[30%] h-[30%] bg-purple-500/10 rounded-full blur-[100px] animate-blob animate-delay-200"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[35%] h-[35%] bg-indigo-500/10 rounded-full blur-[110px] animate-blob animate-delay-400"></div>
    </div>

    <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2 group cursor-pointer">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/20 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-2xl tracking-tight text-slate-900 font-outfit">EasyColoc</span>
                </div>

                <div class="hidden md:flex items-center gap-6">
                    <a href="#features" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors">How it Works</a>
                    @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition-all shadow-sm">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-primary transition-colors">Log in</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-hover transition-all shadow-md shadow-primary/20">
                        Get Started
                    </a>
                    @endauth
                </div>

                <div class="md:hidden">
                    <button class="p-2 text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <header class="relative pt-32 pb-20 md:pt-48 md:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
            <div class="animate-fade-in-up">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-bold tracking-wide uppercase mb-6 border border-primary/20">
                    ✨ The #1 App for Roommates
                </span>
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-slate-900 mb-8 leading-[1.1]">
                    Shared living, <br />
                    <span class="gradient-text">effortlessly organized.</span>
                </h1>
                <p class="mt-6 max-w-2xl mx-auto text-xl text-slate-600 mb-12 leading-relaxed">
                    Say goodbye to awkward money talks. Track expenses, split bills instantly, and manage your home with total transparency.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 bg-slate-900 text-white rounded-xl font-bold text-base hover:bg-slate-800 transform hover:-translate-y-0.5 transition-all shadow-lg">
                        Back to Console
                    </a>
                    @else
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 bg-primary text-white rounded-xl font-bold text-base hover:bg-primary-hover transform hover:-translate-y-0.5 transition-all shadow-xl shadow-primary/20 group">
                        Start for Free
                        <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 bg-white text-slate-900 border border-slate-200 rounded-xl font-bold text-base hover:bg-slate-50 transform hover:-translate-y-0.5 transition-all shadow-md">
                        Live Demo
                    </a>
                    @endauth
                </div>
            </div>

            <div class="mt-20 md:mt-24 relative max-w-5xl mx-auto animate-fade-in-up animate-delay-400">
                <div class="absolute -inset-1 bg-gradient-to-r from-primary to-purple-600 rounded-[2.5rem] blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative rounded-[2rem] bg-slate-900 p-2 md:p-3 overflow-hidden shadow-2xl border border-white/10">
                    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80" alt="EasyColoc Dashboard" class="rounded-[1.5rem] w-full object-cover">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full px-6 flex justify-center">
                        <div class="glass-morphism p-8 rounded-3xl shadow-2xl max-w-md w-full animate-float">
                            <div class="flex justify-between items-center mb-6">
                                <h4 class="font-bold text-slate-800">Recent Grocery Run</h4>
                                <span class="text-primary font-bold">$42.50</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-200"></div>
                                    <div class="flex-1 h-3 bg-slate-100 rounded-full"></div>
                                    <div class="w-12 text-xs font-bold text-slate-400">Owes $14</div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-200"></div>
                                    <div class="flex-1 h-3 bg-slate-100 rounded-full"></div>
                                    <div class="w-12 text-xs font-bold text-slate-400">Owes $14</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="features" class="py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-6">Everything you need to <br /> <span class="text-primary">stay in sync.</span></h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">Focus on the living, let us handle the boring parts of shared management.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="reveal group h-full">
                    <div class="h-full bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-slate-100 group-hover:border-primary/20 group-hover:-translate-y-2 transition-all duration-300">
                        <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mb-8 transform group-hover:rotate-6 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Smart Expense Tracking</h3>
                        <p class="text-slate-600 leading-relaxed italic">"Who paid for the WiFi?"</p>
                        <p class="text-slate-600 leading-relaxed mt-2">Log every shared expense and instantly categorize them for a clear overview.</p>
                    </div>
                </div>

                <div class="reveal animate-delay-200 group h-full">
                    <div class="h-full bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-slate-100 group-hover:border-primary/20 group-hover:-translate-y-2 transition-all duration-300">
                        <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-8 transform group-hover:rotate-6 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Roommate Management</h3>
                        <p class="text-slate-600 leading-relaxed italic">"Is everyone invited?"</p>
                        <p class="text-slate-600 leading-relaxed mt-2">Invite your housemates via link. No more hunting for phone numbers or emails.</p>
                    </div>
                </div>

                <div class="reveal animate-delay-400 group h-full">
                    <div class="h-full bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-slate-100 group-hover:border-primary/20 group-hover:-translate-y-2 transition-all duration-300">
                        <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mb-8 transform group-hover:rotate-6 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Automatic Settlement</h3>
                        <p class="text-slate-600 leading-relaxed italic">"How much do I owe you?"</p>
                        <p class="text-slate-600 leading-relaxed mt-2">Our algorithm calculates the smartest way to settle debts. Fewer transactions, less stress.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="py-24 bg-slate-900 text-white overflow-hidden rounded-[3rem] mx-4 sm:mx-6 mb-20">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="flex-1 reveal">
                    <h2 class="text-4xl md:text-5xl font-extrabold mb-8 leading-tight">Start living better in <br /> <span class="text-primary">3 simple steps.</span></h2>
                    <div class="space-y-8">
                        <div class="flex gap-6 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary/20 border border-primary/30 rounded-full flex items-center justify-center font-bold text-primary group-hover:bg-primary group-hover:text-white transition-all">1</div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Create your Colocation</h4>
                                <p class="text-slate-400">Give it a name, set your currency, and you're ready to go.</p>
                            </div>
                        </div>
                        <div class="flex gap-6 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/10 border border-white/20 rounded-full flex items-center justify-center font-bold text-white group-hover:bg-primary transition-all">2</div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Invite your Roommates</h4>
                                <p class="text-slate-400">Send them a unique invitation link to join the shared space.</p>
                            </div>
                        </div>
                        <div class="flex gap-6 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/10 border border-white/20 rounded-full flex items-center justify-center font-bold text-white group-hover:bg-primary transition-all">3</div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Split and Relax</h4>
                                <p class="text-slate-400">Log expenses as they happen. We handle all the math for you.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 relative reveal animate-delay-400">
                    <div class="relative rounded-3xl overflow-hidden border border-white/10 shadow-3xl">
                        <img src="https://images.unsplash.com/photo-1543269664-76bc3997d9ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Friends laughing" class="w-full">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
                        <div class="absolute bottom-10 left-10">
                            <p class="text-2xl font-bold">"Best decision we made!"</p>
                            <p class="text-primary font-medium mt-1">— Sarah, NYC Resident</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 relative reveal">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-6xl font-extrabold text-slate-900 mb-8">Ready to bring harmony to your home?</h2>
            <p class="text-xl text-slate-600 mb-12">Join thousands of roommates who manage their shared expenses with EasyColoc.</p>
            <div class="flex justify-center flex-wrap gap-4">
                <a href="{{ route('register') }}" class="px-8 py-3.5 bg-primary text-white rounded-xl font-bold text-lg hover:bg-primary-hover shadow-xl shadow-primary/30 transform hover:scale-105 transition-all">
                    Get Started Now
                </a>
            </div>
            <p class="mt-6 text-slate-500 font-medium">Free forever for simple housemates. No credit card required.</p>
        </div>
    </section>

    <footer class="bg-white border-t border-slate-100 pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold">
                            E
                        </div>
                        <span class="font-bold text-xl tracking-tight text-slate-900 font-outfit">EasyColoc</span>
                    </div>
                    <p class="text-slate-500 max-w-xs leading-relaxed">
                        The modern way to manage shared living and housemate finances. Built for transparency and trust.
                    </p>
                </div>
                <div>
                    <h5 class="font-bold text-slate-900 mb-6">Product</h5>
                    <ul class="space-y-4 text-slate-500">
                        <li><a href="#" class="hover:text-primary transition-colors">Features</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Security</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold text-slate-900 mb-6">Support</h5>
                    <ul class="space-y-4 text-slate-500">
                        <li><a href="#" class="hover:text-primary transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-slate-400 text-sm">
                    &copy; {{ date('Y') }} EasyColoc. All rights reserved.
                </p>
                <div class="flex gap-6">
                    <a href="#" class="text-slate-400 hover:text-primary transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-primary transition-colors">
                        <span class="sr-only">GitHub</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }

        window.addEventListener("scroll", reveal);
        window.addEventListener("load", reveal); // Trigger on load too

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('glass-morphism', 'shadow-sm', 'py-2');
                navbar.classList.remove('py-4');
            } else {
                navbar.classList.remove('glass-morphism', 'shadow-sm', 'py-2');
                navbar.classList.add('py-4');
            }
        });
    </script>
</body>

</html>