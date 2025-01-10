import React from "react";
import about from "../Components/Images/about.jpg";
import about2 from "../Components/Images/about-2.jpg";

export default function AboutUs() {
    return (
        <section id="about" className="py-16 bg-gray-50">
            {/* Section Title */}
            <div className="container mx-auto text-center mb-8" data-aos="fade-up">
                <h2 className="text-3xl font-bold text-gray-800 mb-2">Бидний тухай</h2>
                <p className="text-lg text-gray-600">
                    <span className="font-medium">Илүү ихийг </span>
                    <span className="text-primary font-semibold">Бидний тухай мэдэх</span>
                </p>
            </div>

            {/* Section Content */}
            <div className="container mx-auto">
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {/* Left Column */}
                    <div
                        className="flex flex-col items-center"
                        data-aos="fade-up"
                        data-aos-delay="100"
                    >
                        <img src={about} alt="Бидний тухай" className="rounded-lg shadow-lg mb-6" />
                        <div className="text-center">
                            <h3 className="text-xl font-semibold text-gray-800">
                                Ширээ захиалах
                            </h3>
                            <p className="text-lg text-primary">+976 8899 1122</p>
                        </div>
                    </div>

                    {/* Right Column */}
                    <div
                        className="flex flex-col"
                        data-aos="fade-up"
                        data-aos-delay="250"
                    >
                        <div className="lg:pl-8">
                            <p className="italic text-gray-600 mb-4">
                                Манай ресторан чанартай хоол хүнс, найрсаг үйлчилгээтэй орчноороо бахархдаг.
                            </p>
                            <ul className="space-y-3 mb-4">
                                <li className="flex items-start">
                                    <i className="bi bi-check-circle-fill text-primary mr-2"></i>
                                    <span>Таны тав тухыг дээдлэх үйлчилгээтэй.</span>
                                </li>
                                <li className="flex items-start">
                                    <i className="bi bi-check-circle-fill text-primary mr-2"></i>
                                    <span>Хоол бүрт амт, чанарыг баталгаажуулсан.</span>
                                </li>
                                <li className="flex items-start">
                                    <i className="bi bi-check-circle-fill text-primary mr-2"></i>
                                    <span>
                                        Манай хамт олон танд үргэлж найрсаг, түргэн шуурхай үйлчилгээг үзүүлдэг.
                                    </span>
                                </li>
                            </ul>
                            <p className="text-gray-600">
                                Таны тав тух, хоолны амтыг дээдлэхийн тулд бидний хамт олон өдөр бүр хичээн ажиллаж байна. Биднийг сонгон үйлчлүүлдэг танд баярлалаа.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
