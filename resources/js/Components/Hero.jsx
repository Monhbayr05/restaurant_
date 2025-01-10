import React from "react";
import heroImg from "../Components/Images/hero-img.png";

export default function Hero() {
    return (
        <section className="bg-black-100 py-12">
            <div className="container mx-auto px-4">
                <div className="flex flex-col-reverse lg:flex-row justify-center items-center lg:justify-between space-y-8 lg:space-y-0 lg:space-x-8">
                    {/* Left Content */}
                    <div className="lg:w-1/2 flex flex-col justify-center items-start space-y-4">
                        <h1 className="text-4xl lg:text-5xl font-bold text-gray-800">
                            Эрүүл, амттай<br /> хоолоо амтархан зооглоорой
                        </h1>
                        <p className="text-lg text-gray-600">
                            Бид таны хэрэгцээнд нийцсэн амтат хоолыг санал болгодог туршлагатай баг юм.
                        </p>
                        <div className="flex space-x-4">
                            <a
                                href={route("order")}
                                className="bg-orange-500 text-white px-6 py-3 rounded-lg font-medium hover:bg-orange-600 transition"
                            >
                                Захиалга өгөх
                            </a>

                        </div>
                    </div>


                    <div className="lg:w-1/2 flex justify-center items-center">
                        <img
                            src={heroImg} // Corrected variable usage
                            alt="Амтат хоол"
                            className="w-full max-w-md lg:max-w-lg rounded-lg shadow-lg"
                        />
                    </div>
                </div>
            </div>
        </section>
    );
}
