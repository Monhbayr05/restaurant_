import React, { useEffect } from "react";
import iphone from "../Components/Images/Iphone_mockup.png";
import {
    ClockIcon,
    ShoppingBagIcon,
    CreditCardIcon,
} from "@heroicons/react/solid";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

// Register GSAP plugins
if (typeof window !== "undefined") {
    gsap.registerPlugin(ScrollTrigger);
}

export default function Stats() {
    useEffect(() => {
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: "#stats", // The section to trigger
                start: "top top", // Start animation when the top of the section hits the top of the viewport
                end: "bottom+=500px", // Extend the animation to make the iPhone scroll slower
                scrub: 2, // Increase scrub value for slower animation linked to scroll
                pin: ".iphone-mockup", // Pin the iPhone mockup during scrolling
            },
        });

        // iPhone scrolls down with the page and stops
        tl.fromTo(
            ".iphone-mockup",
            { opacity: 1, y: 0 }, // Initial state for iPhone
            { opacity: 1, y: 0, duration: 2, ease: "power3.out" }
        ).to(".iphone-mockup", { y: 400, duration: 8 }); // Moves iPhone further down slower

        // Feature cards animation with independent scroll trigger
        gsap.fromTo(
            [".feature-left .feature-card", ".feature-right .feature-card"],
            { opacity: 0, y: 300 }, // Initial state: invisible and shifted down
            {
                opacity: 1,
                y: 0, // Final state: visible and in original position
                stagger: 0.4, // Stagger animation between cards
                duration: 1, // Duration for each card animation
                ease: "power3.out",
                scrollTrigger: {
                    trigger: "#stats", // Use the #stats section as the trigger
                    start: "top center", // Start animating when the section enters the center of the viewport
                    end: "bottom center", // Sync with the iPhone's animation end
                },
            }
        );
    }, []);

    return (
        <section
            id="stats"
            className="py-12 px-4 bg-gray-50 min-h-[120vh] relative"
        >
            {/* Content Section */}
            <div className="flex flex-col md:flex-row items-center md:justify-center space-y-10 md:space-y-0 md:space-x-20">
                {/* Left Features */}
                <div className="feature-left flex flex-col space-y-10 max-w-md md:mr-8">
                    <FeatureCard
                        icon={
                            <ClockIcon className="h-12 w-12 text-orange-500 mb-4" />
                        }
                        title="Шуурхай үйлчилгээ"
                        description="QR код уншуулснаар захиалгаа түргэн хугацаанд өгөх боломжтой."
                    />
                    <FeatureCard
                        icon={
                            <CreditCardIcon className="h-12 w-12 text-orange-500 mb-4" />
                        }
                        title="Төлбөрийн ил тод байдал"
                        description="Захиалга, төлбөрийн мэдээлэл нь шууд харагдаж хэрэглэгчдэд ил тод байдаг."
                    />
                    <FeatureCard
                        icon={
                            <ShoppingBagIcon className="h-12 w-12 text-orange-500 mb-4" />
                        }
                        title="Захиалга бүрэн хянах"
                        description="Захиалгын мэдээлэл болон төлбөрийн нөхцөлийг шууд харах боломжтой."
                    />
                </div>

                {/* iPhone Mockup */}
                <div className="iphone-mockup relative border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] shadow-xl mx-4 h-[500px] w-[250px] sm:h-[600px] sm:w-[300px] md:h-[800px] md:w-[400px]">
                    <div className="w-[148px] h-[18px] bg-gray-800 top-0 rounded-b-[1rem] left-1/2 -translate-x-1/2 absolute"></div>
                    <div className="h-[46px] w-[3px] bg-gray-800 absolute -left-[17px] top-[124px] rounded-s-lg"></div>
                    <div className="h-[46px] w-[3px] bg-gray-800 absolute -left-[17px] top-[178px] rounded-s-lg"></div>
                    <div className="h-[64px] w-[4px] bg-gray-800 absolute -right-[17px] top-[142px] rounded-e-lg"></div>
                    <div className="rounded-[2rem] overflow-hidden w-full h-full bg-white">
                        <img
                            src={iphone}
                            className="w-full h-full object-cover"
                            alt="iPhone Mockup"
                        />
                    </div>
                </div>

                {/* Right Features */}
                <div className="feature-right flex flex-col space-y-10 max-w-md md:ml-8">
                    <FeatureCard
                        icon={
                            <ClockIcon className="h-12 w-12 text-orange-500 mb-4" />
                        }
                        title="Цаг хэмнэх боломж"
                        description="Меню хайх, зөөгч дуудах зэрэг төвөгтэй алхмуудыг багасгана."
                    />
                    <FeatureCard
                        icon={
                            <ShoppingBagIcon className="h-12 w-12 text-orange-500 mb-4" />
                        }
                        title="Contactless Ordering"
                        description="Миний меню эсвэл зөөгчтэй харилцахгүйгээр QR кодыг ашиглан шууд үйлчилгээнд холбогдоорой."
                    />
                    <FeatureCard
                        icon={
                            <CreditCardIcon className="h-12 w-12 text-orange-500 mb-4" />
                        }
                        title="Баталгаатай төлбөр"
                        description="Таны мэдээлэл аюулгүй бөгөөд шууд үйлчилгээнд хяналт тавьдаг."
                    />
                </div>
            </div>
        </section>
    );
}

function FeatureCard({ icon, title, description }) {
    return (
        <div className="feature-card p-6 bg-white max-w-[300px] min-w-[200px] rounded-lg hover:bg-gray-100 flex flex-col items-center text-center shadow-sm">
            {icon}
            <h3 className="font-bold text-xl text-orange-600 mb-2">{title}</h3>
            <p className="font-normal text-black">{description}</p>
        </div>
    );
}
