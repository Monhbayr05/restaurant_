import React from "react";
import stats from "../Components/Images/stats-bg.jpg";

export default function Stats() {
    return (
        <section id="stats" className="relative bg-gray-900 text-white py-16">
            {/* Background Image */}
            <img
                src={stats}
                alt="Stats Background"
                className="absolute inset-0 w-full h-full object-cover opacity-50"
                data-aos="fade-in"
            />

            <div
                className="container mx-auto relative z-10"
                data-aos="fade-up"
                data-aos-delay="100"
            >
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    {/* Stats Item: Clients */}
                    <div className="text-center flex flex-col items-center justify-center">
                        <span
                            data-purecounter-start="0"
                            data-purecounter-end="232"
                            data-purecounter-duration="1"
                            className="purecounter text-4xl font-bold"
                        ></span>
                        <p className="text-lg mt-2">Clients</p>
                    </div>

                    {/* Stats Item: Projects */}
                    <div className="text-center flex flex-col items-center justify-center">
                        <span
                            data-purecounter-start="0"
                            data-purecounter-end="521"
                            data-purecounter-duration="1"
                            className="purecounter text-4xl font-bold"
                        ></span>
                        <p className="text-lg mt-2">Projects</p>
                    </div>

                    {/* Stats Item: Hours of Support */}
                    <div className="text-center flex flex-col items-center justify-center">
                        <span
                            data-purecounter-start="0"
                            data-purecounter-end="1453"
                            data-purecounter-duration="1"
                            className="purecounter text-4xl font-bold"
                        ></span>
                        <p className="text-lg mt-2">Hours Of Support</p>
                    </div>

                    {/* Stats Item: Workers */}
                    <div className="text-center flex flex-col items-center justify-center">
                        <span
                            data-purecounter-start="0"
                            data-purecounter-end="32"
                            data-purecounter-duration="1"
                            className="purecounter text-4xl font-bold"
                        ></span>
                        <p className="text-lg mt-2">Workers</p>
                    </div>
                </div>
            </div>
        </section>
    );
}
