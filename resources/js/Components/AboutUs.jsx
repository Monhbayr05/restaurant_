import React from "react";
import iphone from "../Components/Images/Iphone_mockup.png";
import qr from "../Components/Images/qr.png";
import order from "../Components/Images/order.png";
import byl from "../Components/Images/byl.png";

export default function AboutUs() {
    return (
        <section
            id="stats"
            className="py-20 px-6 bg-gray-50 min-h-[100vh]  shadow-lg relative z-10"
        >
            {/* Orange Background Section */}
            <div className="bg-gray-50 rounded-xl p-12 ">
                {/* Content Section */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-10 items-center">
                    {/* iPhone Mockup 1 */}
                    <div className="flex flex-col items-center">
                        <div className="text-center max-w-sm mb-6">
                            <div className="p-6 rounded-lg shadow-md bg-blue-50 border border-blue-200">
                                <h1 className="text-3xl font-bold text-blue-600 mb-2">1</h1>
                                <p className="text-gray-700 text-lg">
                                    Та утсаа нээгээд QR уншуулна.
                                </p>
                            </div>
                        </div>
                        <div className="relative border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] shadow-2xl h-[400px] w-[200px] sm:h-[500px] sm:w-[250px] md:h-[600px] md:w-[300px] lg:h-[700px] lg:w-[350px]">
                            <div className="w-[100px] h-[14px] bg-gray-800 top-0 rounded-b-[1rem] left-1/2 -translate-x-1/2 absolute"></div>
                            <div className="rounded-[2rem] overflow-hidden w-full h-full bg-white">
                                <img
                                    src={qr}
                                    className="w-full h-full object-cover"
                                    alt="iPhone Mockup"
                                />
                            </div>
                        </div>
                    </div>

                    {/* iPhone Mockup 2 */}
                    <div className="flex flex-col items-center">
                        <div className="text-center max-w-sm mb-6">
                            <div className="p-6 rounded-lg shadow-md bg-green-50 border border-green-200">
                                <h1 className="text-3xl font-bold text-green-600 mb-2">2</h1>
                                <p className="text-gray-700 text-lg">
                                    Та менюгээ сонгоно уу.
                                </p>
                            </div>
                        </div>
                        <div className="relative border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] shadow-2xl h-[400px] w-[200px] sm:h-[500px] sm:w-[250px] md:h-[600px] md:w-[300px] lg:h-[700px] lg:w-[350px]">
                            <div className="w-[100px] h-[14px] bg-gray-800 top-0 rounded-b-[1rem] left-1/2 -translate-x-1/2 absolute"></div>
                            <div className="rounded-[2rem] overflow-hidden w-full h-full bg-white">
                                <img
                                    src={order}
                                    className="w-full h-full object-cover"
                                    alt="iPhone Mockup"
                                />
                            </div>
                        </div>
                    </div>

                    {/* iPhone Mockup 3 */}
                    <div className="flex flex-col items-center">
                        <div className="text-center max-w-sm mb-6">
                            <div className="p-6 rounded-lg shadow-md bg-yellow-50 border border-yellow-200">
                                <h1 className="text-3xl font-bold text-yellow-600 mb-2">3</h1>
                                <p className="text-gray-700 text-lg">
                                    Захиалгаа баталгаажуулна уу.
                                </p>
                            </div>
                        </div>
                        <div className="relative border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] shadow-2xl h-[400px] w-[200px] sm:h-[500px] sm:w-[250px] md:h-[600px] md:w-[300px] lg:h-[700px] lg:w-[350px]">
                            <div className="w-[100px] h-[14px] bg-gray-800 top-0 rounded-b-[1rem] left-1/2 -translate-x-1/2 absolute"></div>
                            <div className="rounded-[2rem] overflow-hidden w-full h-full bg-white">
                                <img
                                    src={byl}
                                    className="w-full h-full object-cover"
                                    alt="iPhone Mockup"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
