import React from "react";

export default function Contact() {
    return (
        <section className="bg-gray-50">
            <div className="py-12 lg:py-20 px-8 mx-auto max-w-5xl">
                {/* Title Section */}
                <div className="text-center mb-12">
                    <p className="text-sm font-semibold text-orange-600 uppercase tracking-wider">
                        Бидэнтэй холбогдох
                    </p>
                    <h1 className="text-4xl sm:text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Let's Talk
                    </h1>
                    <h2 className="text-lg sm:text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto">
                        Бидний хүсэлтэй хамтран ажил. Асуулт, санал, эсвэл тусламж хэрэгтэй бол
                        бид танд туслахад бэлэн байна.
                    </h2>
                </div>

                {/* Contact Form */}
                <form action="#" className="space-y-8 bg-white rounded-lg shadow-lg p-8">
                    {/* Email Field */}
                    <div>
                        <label
                            htmlFor="email"
                            className="block mb-2 text-sm font-medium text-gray-700"
                        >
                            Your Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            className="block w-full p-3 text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:ring-orange-500 focus:border-orange-500"
                            placeholder="name@example.com"
                            required
                        />
                    </div>

                    {/* Subject Field */}
                    <div>
                        <label
                            htmlFor="subject"
                            className="block mb-2 text-sm font-medium text-gray-700"
                        >
                            Subject
                        </label>
                        <input
                            type="text"
                            id="subject"
                            className="block w-full p-3 text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:ring-orange-500 focus:border-orange-500"
                            placeholder="How can we assist you?"
                            required
                        />
                    </div>

                    {/* Message Field */}
                    <div>
                        <label
                            htmlFor="message"
                            className="block mb-2 text-sm font-medium text-gray-700"
                        >
                            Your Message
                        </label>
                        <textarea
                            id="message"
                            rows="6"
                            className="block w-full p-3 text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:ring-orange-500 focus:border-orange-500"
                            placeholder="Write your message here..."
                            required
                        ></textarea>
                    </div>

                    {/* Submit Button */}
                    <div className="text-center">
                        <button
                            type="submit"
                            className="py-3 px-8 text-base font-medium text-white bg-orange-600 rounded-md shadow-lg hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 transition duration-200"
                        >
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </section>
    );
}
