import React, { useState, useEffect } from "react";
import { Link } from "@inertiajs/react";

export default function Checkout() {
    const [cartItems, setCartItems] = useState(() => {
        const storedCart = localStorage.getItem("cart");
        return storedCart ? JSON.parse(storedCart) : [];
    });



    const [phoneNumber, setPhoneNumber] = useState(localStorage.getItem("phoneNumber") || "");
    const [description, setDescription] = useState(localStorage.getItem("description") || "");
    const [table_id, setTableId] = useState(localStorage.getItem("tableId") || 0); // Default table_id is 1

    const totalPrice = cartItems.reduce(
        (acc, item) => acc + item.price * item.quantity,
        0
    );

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");

    useEffect(() => {
        localStorage.setItem("phoneNumber", phoneNumber);
    }, [phoneNumber]);

    useEffect(() => {
        localStorage.setItem("description", description);
    }, [description]);

    return (
        <div className="min-h-screen bg-gray-50">
            <div className="container mx-auto px-4 py-10">
                <h2 className="text-2xl font-bold text-gray-700 mb-6 text-center">
                    Төлбөр төлөх
                </h2>

                <div className="grid md:grid-cols-2 gap-8">
                    <div className="bg-white rounded-lg shadow p-6">
                        <h3 className="text-lg font-semibold mb-4 text-gray-700">Таны захиалга</h3>
                        {cartItems.length > 0 ? (
                            <>
                                {cartItems.map((item) => (
                                    <div
                                        key={item.id}
                                        className="flex items-start mb-4 border-b border-gray-200 pb-4"
                                    >
                                        <div>
                                            <p className="text-xl font-medium text-orange-500">
                                                {item.name}
                                            </p>
                                            <p className="text-gray-600 text-sm">
                                                {item.price.toFixed(2)}₮ x {item.quantity}
                                            </p>
                                            <p className="text-gray-500 text-xs mt-1">
                                                Нийт:{" "}
                                                <span className="font-semibold">
                                                    {(item.price * item.quantity).toFixed(2)}₮
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                ))}

                                <div className="border-t border-gray-200 pt-4 mt-4">
                                    <div className="flex justify-between items-center">
                                        <span className="font-bold text-lg text-gray-700">
                                            Нийт
                                        </span>
                                        <span className="font-bold text-lg text-gray-800">
                                            {totalPrice.toFixed(2)}₮
                                        </span>
                                    </div>
                                </div>
                            </>
                        ) : (
                            <p className="text-gray-500">Таны сагс хоосон байна.</p>
                        )}
                    </div>

                    <div className="bg-white rounded-lg shadow p-6">
                        <h3 className="text-lg font-semibold mb-4 text-gray-700">
                            Захиалгын мэдээлэл ({table_id && `${table_id}-р ширээ`})
                        </h3>

                        <form
                            method="POST"
                            action={route('order.checkout.store')}
                            className="space-y-5"
                        >
                            <input type="hidden" name="_token" value={csrfToken} />

                            <div>
                                <label
                                    htmlFor="phoneNumber"
                                    className="block font-medium text-gray-700 mb-1"
                                >
                                    Утасны дугаар:
                                </label>
                                <input
                                    id="phoneNumber"
                                    name="phone"
                                    type="tel"
                                    value={phoneNumber}
                                    placeholder="9999-9999"
                                    onChange={(e) => setPhoneNumber(e.target.value)}
                                    className="w-full px-3 py-2 border border-gray-300
                                               rounded focus:ring-2 focus:ring-orange-500
                                               focus:outline-none"
                                    required
                                />
                            </div>

                            <div>
                                <label
                                    htmlFor="description"
                                    className="block font-medium text-gray-700 mb-1"
                                >
                                    Нэмэлт тайлбар:
                                </label>
                                <textarea
                                    id="description"
                                    name="notes"
                                    rows="4"
                                    value={description}
                                    className="w-full px-3 py-2 border border-gray-300
                                               rounded focus:ring-2 focus:ring-orange-500
                                               focus:outline-none"
                                    placeholder="Хэрэв таньд мэдэгдэх зүйл байвал бичнэ үү..."
                                    onChange={(e) => setDescription(e.target.value)}
                                />
                            </div>

                            <input type="hidden" name="table_id" value={table_id || ""} />
                            <input
                                type="hidden"
                                name="cart_items"
                                value={JSON.stringify(cartItems)}
                            />

                            <button
                                type="submit"
                                className="w-full bg-orange-500 text-white py-2 px-4 rounded
                                           hover:bg-orange-600 transition-colors"
                            >
                                Төлөх: {totalPrice.toFixed(2)}₮
                            </button>
                        </form>

                        <Link
                            href={route("order")}
                            className="block text-center mt-4 bg-gray-300 text-gray-700
                                       py-2 px-4 rounded hover:bg-gray-400 transition-colors"
                        >
                            Болих
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
}
