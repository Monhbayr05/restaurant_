import React from "react";

export default function Hero() {
    return (
        <main className="mt-1">
            <div className="flex flex-col items-center min-h-screen p-4">
                <div className="text-center mt-8">
                    <div className="flex justify-center mb-4">
                        {/* Placeholder for logo image */}
                        <div className="w-32 h-32 rounded-full bg-[#170801] flex items-center justify-center">
                            <img
                                src={logoImage}
                                alt="Logo"
                                className="w-full h-full object-cover rounded-full"
                            />
                        </div>
                    </div>
                    <div className="text-5xl font-bold">FoodBazalt</div>
                    <div className="text-2xl mt-2 text-[#B0C3C7]">
                        <h2>Where Flavor Meets Innovation</h2>
                    </div>
                </div>

                {/* Menu Section */}
                <div className="flex justify-center mt-10 space-x-4">
                    <div className="flex flex-col items-center justify-center bg-[#f79e6e] text-[#495C61] w-48 h-48 rounded-lg text-lg font-semibold">
                        <i className="bi bi-qr-code mb-2 text-6xl"></i>
                        <span>Цэс харах</span>
                    </div>
                    <div className="flex flex-col items-center justify-center bg-[#f79e6e] text-[#495C61] w-48 h-48 rounded-lg text-lg font-semibold">
                        <i className="bi bi-basket3 mb-2 text-6xl"></i>
                        <span>Авч явах</span>
                    </div>
                </div>
            </div>
        </main>
    );
}
