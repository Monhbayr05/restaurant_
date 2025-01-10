import React from "react";
import { Link, Head } from "@inertiajs/react";
import logoImage from "../Components/Images/logoo.png";
import Footer from "../Components/Footer";
import Hero from "../Components/Hero";
import AboutUs from "@/Components/AboutUs";
import WhyUs from "@/Components/WhyUs";
import Stats from "@/Components/Stats";


export default function Welcome({ auth, laravelVersion, phpVersion }) {
    return (
        <>
            <Head title="Welcome" />
            <div>
                <header
                    id="header"
                    class="sticky top-0 bg-white shadow-md w-full rounded-full"
                >
                    <div class="container mx-auto flex items-center justify-between p-4">
                        <a
                            href="index.html"
                            class="flex items-center space-x-2"
                        >
                            {/* Logo */}
                            <img
                                src={logoImage}
                                alt="Logo"
                                className="max-h-[80px]"
                            />
                            <h1 class="text-xl font-bold text-gray-800">
                                FoodBazalt
                            </h1>
                            <span class="text-primary">.</span>
                        </a>

                        <nav
                            id="navmenu"
                            class="hidden lg:flex items-center space-x-6"
                        >
                            <ul class="flex space-x-6 text-gray-800">
                                <li>
                                    <a
                                        href="#hero"
                                        class="text-primary font-semibold hover:text-primary-dark"
                                    >
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#about" class="hover:text-primary">
                                        About
                                    </a>
                                </li>
                                <div>
                                    {auth.user ? (
                                        <Link
                                            href={route("dashboard")}
                                            className="rounded-md px-3 py-2 bg-orange-500 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                        >
                                            Dashboard
                                        </Link>
                                    ) : (
                                        <>
                                            <Link
                                                href={route("login")}
                                                className="rounded-md mx-2 px-3 py-2 bg-orange-500 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                            >
                                                Log in
                                            </Link>
                                            <Link
                                                href={route("order")}
                                                className="rounded-md px-3 py-2 bg-orange-500 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                            >
                                                Order
                                            </Link>
                                        </>
                                    )}
                                </div>
                            </ul>
                            <i class="mobile-nav-toggle hidden bi bi-list"></i>
                        </nav>

                        <i class="mobile-nav-toggle lg:hidden bi bi-list text-2xl text-gray-800 cursor-pointer"></i>
                    </div>
                </header>
                <main>
                    <Hero />
                    <AboutUs />
                    <WhyUs />
                    <Stats />
                </main>

                <Footer />
            </div>
        </>
    );
}
