import React, { useEffect, useState } from "react";
import iphone from "../Components/Images/Iphone_mockup.png";
import admin from "../Components/Images/admin_mockup.png";
import qrCode1 from "../Components/Images/qr_code_1.png";
import qrCode2 from "../Components/Images/qr_code_2.png";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";


if (typeof window !== "undefined") {
    gsap.registerPlugin(ScrollTrigger);
}

const randomQRData = [
    { name: "Монгол Хоол", top: "0%", left: "5%", rotation: "-50deg" },
    { name: "Гэр Бууз", top: "50%", left: "75%", rotation: "10deg" },
    { name: "Тал Хээр", top: "10%", left: "80%", rotation: "-15deg" },
    { name: "Хорхогт", top: "60%", left: "0%", rotation: "5deg" },
    { name: "Монгол Хоол", top: "30%", left: "45%", rotation: "-50deg" },
    { name: "Гэр Бууз", top: "6%", left: "20%", rotation: "0deg" },
    { name: "Тал Хээр", top: "70%", left: "80%", rotation: "-15deg" },
    { name: "Хорхогт", top: "87%", left: "10%", rotation: "-150deg" },
    { name: "Баян Бууз", top: "40%", left: "10%", rotation: "-10deg" },
    { name: "Улаанбаатар BBQ", top: "100%", left: "50%", rotation: "20deg" }
];

export default function Hero() {
    const [isLaptopVisible, setIsLaptopVisible] = useState(true);

    useEffect(() => {
        const handleResize = () => {
            setIsLaptopVisible(window.innerWidth > 768);
        };

        window.addEventListener("resize", handleResize);
        handleResize();

        return () => window.removeEventListener("resize", handleResize);
    }, []);

    useEffect(() => {
        gsap.fromTo(
            ".laptop-mockup, .mobile-mockup, .random-qr", 
            { opacity: 0, y: 50 }, 
            {
                opacity: 1,
                y: 0,
                duration: 1.5,
                stagger: 0.2,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: ".container",
                    start: "top 80%",
                },
            }
        );

        gsap.fromTo(
            "#why-us",
            { opacity: 0, y: 100 },
            {
                opacity: 1,
                y: 0,
                duration: 1.5,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: "#why-us",
                    start: "top 90%",
                },
            }
        );
    }, []);

    return (
        <>
            <section className="bg-gray-100 py-12 flex flex-col items-center justify-center min-h-[100vh] relative">
                {/* Mockup Section */}
                <div className="container mx-auto flex items-center justify-center h-auto relative">
                    {/* Laptop Mockup */}
                    {isLaptopVisible && (
                        <div className="laptop-mockup relative h-[600px] max-w-[900px] mx-auto z-0">
                            <div className="border-gray-800 bg-gray-800 border-[12px] rounded-xl shadow-lg h-full">
                                <div className="rounded-lg overflow-hidden h-full bg-white">
                                    <img
                                        src={admin}
                                        className="h-full w-full rounded-lg object-contain"
                                        alt="Laptop Screen"
                                    />
                                </div>
                            </div>
                        </div>
                    )}

                    {/* Mobile Mockup */}
                    <div className="mobile-mockup absolute h-[460px] w-[240px] top-[30%] left-[20%] z-10 border-[10px] border-gray-800 rounded-[1.5rem] bg-gray-100 shadow-xl">
                        <div className="relative bg-white h-full w-full rounded-[1.5rem] overflow-hidden">
                            <div className="absolute top-0 left-1/2 -translate-x-1/2 w-[80px] h-[14px] bg-gray-800 rounded-b-[0.8rem]"></div>
                            <div className="rounded-[1rem] overflow-hidden bg-white p-2">
                                <img
                                    src={iphone}
                                    className="h-full w-full object-contain"
                                    alt="Mobile Mockup"
                                />
                            </div>
                        </div>
                    </div>

                    {/* Random QR Codes */}
                    {randomQRData.map((qr, index) => (
                        <div
                            key={index}
                            className={`random-qr absolute flex flex-col items-center text-center z-10 opacity-70`}
                            style={{
                                top: qr.top,
                                left: qr.left,
                                transform: `rotate(${qr.rotation})`,
                            }}
                        >
                            <div className="text-xs font-bold bg-orange-500 text-white px-2 py-1 rounded-md mb-1">
                                {qr.name}
                            </div>
                            <div className="relative h-[80px] w-[80px] bg-white p-2 rounded-lg shadow-lg">
                                <img
                                    src={index % 2 === 0 ? qrCode1 : qrCode2}
                                    alt={`QR Code ${index + 1}`}
                                    className="h-full w-full object-contain rounded-lg"
                                />
                            </div>
                        </div>
                    ))}
                </div>
            </section>
        </>
    );
}
