import React, { useState, useEffect } from "react";
import axios from "axios";

const Cart = ({ cartItems, setCartItems }) => {
    const bearerToken = "p0dOx59YXXAEbwSXwYvlfBoRYCI1JYUAiwteVABd8100c42a";
    const [isDropdownOpen, setDropdownOpen] = useState(false);
    const [isModalOpen, setModalOpen] = useState(false);
    const [description, setNotes] = useState(
        localStorage.getItem("description") || ""
    );
    const [tableId, setTableId] = useState(
        localStorage.getItem("tableId") || null
    );
    const [phoneNumber, setPhoneNumber] = useState(
        localStorage.getItem("phoneNumber") || ""
    );
    

    const totalPrice = cartItems.reduce(
        (total, item) => total + item.price * item.quantity,
        0
    );

    // Sync description and tableId to localStorage
    useEffect(() => {
        localStorage.setItem("description", description);
    }, [description]);

    useEffect(() => {
        localStorage.setItem("phoneNumber", phoneNumber);
    }, [phoneNumber]);

    // Add item to cart
    const handleAddToCart = (product) => {
        const existingItem = cartItems.find((item) => item.id === product.id);

        const updatedCart = existingItem
            ? cartItems.map((item) =>
                  item.id === product.id
                      ? { ...item, quantity: item.quantity + 1 }
                      : item
              )
            : [...cartItems, { ...product, quantity: 1 }];

        setCartItems(updatedCart);
        localStorage.setItem("cart", JSON.stringify(updatedCart));
    };

    // Remove item from cart
    const handleRemoveFromCart = (product) => {
        const existingItem = cartItems.find((item) => item.id === product.id);

        const updatedCart =
            existingItem.quantity > 1
                ? cartItems.map((item) =>
                      item.id === product.id
                          ? { ...item, quantity: item.quantity - 1 }
                          : item
                  )
                : cartItems.filter((item) => item.id !== product.id);

        setCartItems(updatedCart);
        localStorage.setItem("cart", JSON.stringify(updatedCart));
    };

    // Handle form submission
    const handleFormSubmit = async (e) => {
        e.preventDefault();

        const csrfToken = document
            .querySelector('meta[name="csrf-token1"]')
            .getAttribute("content");

        const checkoutData = {
            totalAmount: totalPrice,
            cartItems: cartItems.map(({ id, name, price, quantity }) => ({
                id,
                name,
                price,
                quantity,
            })),
            description,
            tableId,
            phoneNumber,
        };

        try {
             console.log(totalPrice, phoneNumber);
            const bylResponse = await axios.post(
                "https://byl.mn/api/v1/projects/117/invoices",
                {
                    amount: totalPrice,
                    description: phoneNumber,
                },
                {
                    headers: {
                        Authorization: `Bearer ${bearerToken}`,
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        "Accept": "application/json",
                    },
                }
            );

            console.log("Byl API Response:", bylResponse.data);
            alert("Захиалга амжилттай хийгдлээ!");
            setCartItems([]);
            localStorage.removeItem("cart");
        } catch (error) {
            if (error.response) {
                console.error("Server-side error:", error.response.data);
                alert(
                    `Алдаа гарлаа: ${
                        error.response.data.message || "Unknown error"
                    }`
                );
            } else if (error.request) {
                console.error("Network error:", error.request);
                alert("Сүлжээний алдаа гарлаа.");
            } else {
                console.error("Error:", error.message);
                alert("Алдаа гарлаа.");
            }
        }
    };

    return (
        <div className="justify-center w-full">
            {/* Header */}
            <div
                className="w-full rounded-t-lg bg-orange-500 flex justify-between items-center py-2 cursor-pointer"
                onClick={() => setDropdownOpen(!isDropdownOpen)}
                aria-expanded={isDropdownOpen}
            >
                <h2 className="px-2 text-lg font-bold text-white">
                    Миний захиалга
                </h2>
                <h2 className="px-2 text-lg font-bold text-white">
                    Нийт: {totalPrice.toFixed(2)} ₮
                </h2>
            </div>

            {/* Dropdown */}
            {isDropdownOpen && (
                <div className="bg-white w-full flex justify-center">
                    <div className="w-full max-w-[300px] bg-white rounded-lg shadow-lg p-4">
                        <ul className="max-h-40 overflow-y-auto mb-4">
                            {cartItems.length > 0 ? (
                                cartItems.map((item) => (
                                    <li
                                        key={item.id}
                                        className="mb-4 flex justify-between items-center"
                                    >
                                        <img
                                            src={item.thumbnail}
                                            alt={item.name}
                                            className="w-[40px] h-[40px] object-cover rounded"
                                        />
                                        <span className="text-sm">
                                            {item.name} -{" "}
                                            {item.price.toFixed(2)}₮ x{" "}
                                            {item.quantity}
                                        </span>
                                        <div className="flex space-x-2">
                                            <button
                                                onClick={() =>
                                                    handleAddToCart(item)
                                                }
                                                className="text-white bg-orange-500 px-2 py-1 rounded-full hover:bg-orange-600"
                                            >
                                                +
                                            </button>
                                            <button
                                                onClick={() =>
                                                    handleRemoveFromCart(item)
                                                }
                                                className="text-white bg-red-500 px-2 py-1 rounded-full hover:bg-red-600"
                                            >
                                                -
                                            </button>
                                        </div>
                                    </li>
                                ))
                            ) : (
                                <li className="text-center text-gray-500">
                                    Захиалга хоосон байна.
                                </li>
                            )}
                        </ul>
                        <button
                            onClick={() => setModalOpen(true)}
                            className="w-full bg-orange-500 text-white px-4 py-2 mt-4 rounded-lg hover:bg-orange-600"
                            disabled={cartItems.length === 0}
                        >
                            Төлөх: {totalPrice.toFixed(2)}₮
                        </button>
                    </div>
                </div>
            )}

            {/* Modal */}
            {isModalOpen && (
                <div className="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                    <div className="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
                        <h2 className="text-xl font-bold mb-4">Төлбөр төлөх</h2>
                        <form onSubmit={handleFormSubmit} className="space-y-4">
                            <input
                                type="tel"
                                placeholder="Утасны дугаар"
                                value={phoneNumber}
                                onChange={(e) => setPhoneNumber(e.target.value)}
                                className="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none"
                                required
                            />
                            <textarea
                                name="description"
                                rows="4"
                                className="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none"
                                placeholder="Хэрэв таньд бидэнд мэдэгдэх зүйл байвал заавал бичнэ үү. (Харшилтай, Давс хэрэглэдэггүй гэх мэт)"
                                value={description}
                                onChange={(e) => setNotes(e.target.value)}
                            ></textarea>
                            <button
                                type="submit"
                                className="w-full bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600"
                            >
                                Төлөх: {totalPrice.toFixed(2)}₮
                            </button>
                        </form>
                        <button
                            onClick={() => setModalOpen(false)}
                            className="mt-4 w-full bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400"
                        >
                            Болих
                        </button>
                    </div>
                </div>
            )}
        </div>
    );
};

export default Cart;
