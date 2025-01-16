import React from "react";
import { Link, Head } from "@inertiajs/react";
import logoImage from "../Components/Images/logoo2.png";
import Footer from "../Components/Footer";
import Hero from "../Components/Hero";
import AboutUs from "@/Components/AboutUs";
import WhyUs from "@/Components/WhyUs";
import Stats from "@/Components/Stats";
import Contact from "@/Components/Contact";
import "@/Components/css/welcome.css";

export default function Welcome({ auth, laravelVersion, phpVersion }) {
    return (
        <>
            <Head title="Welcome" />
            <div>
                <header className=" top-0 bg-white shadow-md w-full rounded-lg z-50">
                    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 ">
                        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                            <a
                                href="https://foodbazalt.online"
                                class="flex items-center"
                            >
                                <img
                                    src={logoImage}
                                    class="mr-3 h-12 sm:h-15"
                                    alt="Flowbite Logo"
                                />
                            </a>
                            <div class="flex items-center lg:order-2">
                                {auth.user ? (
                                    <Link
                                        href={route("dashboard")}
                                        className="rounded-md px-3 py-2 bg-orange-500 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Хяналтын самбар
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route("login")}
                                            className="rounded-md mx-2 px-3 py-2 bg-orange-500 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                        >
                                            Нэвтрэх
                                        </Link>
                                    </>
                                )}
                            </div>
                        </div>
                    </nav>
                </header>

                <main>
                    <Hero />
                    <WhyUs
                        subtitle="Таны цаг хугацааг хэмнэнэ."
                        title="QR код уншдаг рестораны систем."
                        description="Зөөгчөөс асуух шаардлагагүй, QR кодыг ашиглан шууд үйлчилгээнд холбогдоорой."
                    />
                    <Stats />
                    <WhyUs
                        subtitle="Өөрчлөлтийг мэдрээрэй."
                        title="Хэрэглэгчийн тав тухыг нэн тэргүүнд тавьсан."
                        description="Бидний систем нь таны амьдралыг хялбарчлах болно."
                    />
                    <AboutUs />
                    <Contact />
                </main>

                <Footer />
            </div>
        </>
    );
}
