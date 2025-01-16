import React, { useEffect } from "react";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

// Register GSAP plugins
if (typeof window !== "undefined") {
    gsap.registerPlugin(ScrollTrigger);
}

export default function WhyUs({ title, subtitle, description }) {
    useEffect(() => {
        // GSAP Animation
        gsap.fromTo(
            "#why-us .title",
            { opacity: 0, y: 50 }, // Start state: Invisible and shifted down
            {
                opacity: 1,
                y: 0, // End state: Fully visible and back to original position
                duration: 1.5,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: "#why-us", // Trigger the animation when #why-us enters the viewport
                    start: "top 80%", // Animation starts when the top of #why-us hits 80% of the viewport
                    toggleActions: "play none none reverse", // Play the animation on scroll and reverse on scroll up
                },
            }
        );
    }, []);

    return (
        <section
            id="why-us"
            className="flex flex-col items-center justify-center py-16 bg-white min-h-[600px]"
        >
            {/* Title Section */}
            <div className="title">
                <p className="text-sm font-bold text-orange-600 mb-4 tracking-wide">
                    {subtitle}
                </p>
                <h1 className="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                    {title}
                </h1>
                <h2 className="text-lg sm:text-xl md:text-2xl italic text-gray-600 leading-relaxed max-w-3xl mx-auto">
                    {description}
                </h2>
            </div>
        </section>
    );
}
