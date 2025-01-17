import React from "react";

export default function Contact() {
    return (
        <section className="bg-gray-50">
            <div className="py-12 lg:py-20 px-8 mx-auto max-w-5xl">
                {/* Title Section */}
                {/* Title Section */}
                <div className="title py-5">
                    <p className="text-lg font-bold text-orange-600 mb-4 tracking-wide">
                        Бидэнтэй холбогдох
                    </p>
                    <h1 className="text-6xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                        Let's Talk
                    </h1>
                    <h2 className="text-lg sm:text-xl md:text-2xl italic text-gray-600 leading-relaxed max-w-3xl mx-auto">
                        Бидний хүсэлтэй хамтран ажил. Асуулт, санал, эсвэл
                        тусламж хэрэгтэй бол бид танд туслахад бэлэн байна.
                    </h2>
                </div>

                {/* Contact Form */}
                <form
                    action="#"
                    className="space-y-8 bg-gray-50 rounded-lg pt-8"
                >
                    {/* Name and Email Fields */}
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                htmlFor="name"
                                className="block mb-2 text-xl font-medium text-gray-700"
                            >
                                Таны Нэр
                            </label>
                            <input
                                type="text"
                                id="name"
                                className="block w-full p-3 text-gray-900 bg-gray-50 rounded-md border border-orange-300 focus:ring-orange-500 focus:border-orange-500 text-xl"
                                placeholder="John Doe"
                                required
                            />
                        </div>
                        <div>
                            <label
                                htmlFor="email"
                                className="block mb-2 text-xl font-medium text-gray-700"
                            >
                                И-мейл хаяг
                            </label>
                            <input
                                type="email"
                                id="email"
                                className=" text-xl block w-full p-3 text-gray-900 bg-gray-50 rounded-md border border-orange-300 focus:ring-orange-500 focus:border-orange-500"
                                placeholder="name@example.com"
                                required
                            />
                        </div>
                    </div>

                    {/* Subject Field */}
                    <div>
                        <label
                            htmlFor="subject"
                            className="text-xl block mb-2 font-medium text-gray-700"
                        >
                            Төсөл
                        </label>
                        <input
                            type="text"
                            id="subject"
                            className="text-xl block w-full p-3 text-gray-900 bg-gray-50 rounded-md border border-orange-300 focus:ring-orange-500 focus:border-orange-500"
                            placeholder="How can we assist you?"
                            required
                        />
                    </div>

                    {/* Message Field */}
                    <div>
                        <label
                            htmlFor="message"
                            className="block mb-2 text-xl font-medium text-gray-700"
                        >
                            Дэлгэрэнгүй
                        </label>
                        <textarea
                            id="message"
                            rows="6"
                            className="text-xl block w-full p-3 text-gray-900 bg-gray-50 rounded-md border border-orange-300 focus:ring-orange-500 focus:border-orange-500"
                            placeholder="Write your message here..."
                            required
                        ></textarea>
                    </div>

                    {/* Submit Button */}
                    <div className="text-center">
                        <button
                            type="submit"
                            className=" text-3xl py-3 px-8 font-medium text-white bg-orange-600 rounded-md shadow-lg hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 transition duration-200"
                        >
                            Илгээх
                        </button>
                    </div>
                </form>
            </div>
        </section>
    );
}
