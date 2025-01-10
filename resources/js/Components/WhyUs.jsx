import React from "react";

export default function WhyUs() {
    return (
        <section id="why-us" className="py-16 bg-gray-100">
            <div className="container mx-auto">
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div
                        data-aos="fade-up"
                        data-aos-delay="100"
                        className="bg-white p-6 rounded-lg shadow-lg"
                    >
                        <h3 className="text-2xl font-bold text-gray-800 mb-4">
                            Яагаад FoodBazalt-г сонгох вэ?
                        </h3>
                        <p className="text-gray-600 mb-6">
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Duis aute irure dolor in
                            reprehenderit Asperiores dolores sed et. Tenetur
                            quia eos. Autem tempore quibusdam vel necessitatibus
                            optio ad corporis.
                        </p>
                        <div className="text-center">
                            <a
                                href="#"
                                className="inline-flex items-center text-primary hover:underline"
                            >
                                <span>Дэлгэрэнгүй</span>{" "}
                                <i className="bi bi-chevron-right ml-2"></i>
                            </a>
                        </div>
                    </div>

                    <div
                        className="lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6"
                        data-aos="fade-up"
                        data-aos-delay="200"
                    >
                        <div className="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center text-center">
                            <i className="bi bi-clipboard-data text-primary text-4xl mb-4"></i>
                            <h4 className="text-xl font-semibold text-gray-800 mb-2">
                                Үйлчилгээний чанар
                            </h4>
                            <p className="text-gray-600">
                                Манай үйлчлүүлэгчдэд чанартай, найдвартай
                                үйлчилгээг үргэлж хүргэхийг зорьдог.
                            </p>
                        </div>

                        <div
                            className="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center text-center"
                            data-aos="fade-up"
                            data-aos-delay="300"
                        >
                            <i className="bi bi-gem text-primary text-4xl mb-4"></i>
                            <h4 className="text-xl font-semibold text-gray-800 mb-2">
                                Өвөрмөц амт чанар
                            </h4>
                            <p className="text-gray-600">
                                Хоол бүрт өвөрмөц амт, шинэлэг орц найрлагыг
                                амлаж байна.
                            </p>
                        </div>

                        <div
                            className="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center text-center"
                            data-aos="fade-up"
                            data-aos-delay="400"
                        >
                            <i className="bi bi-inboxes text-primary text-4xl mb-4"></i>
                            <h4 className="text-xl font-semibold text-gray-800 mb-2">
                                Түргэн хүргэлт
                            </h4>
                            <p className="text-gray-600">
                                Хоолыг тань түргэн шуурхай, аюулгүйгээр таны
                                гарт хүргэнэ.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
