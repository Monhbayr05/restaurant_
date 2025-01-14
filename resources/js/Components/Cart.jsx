import React, { useState, useEffect } from "react";

const Cart = ({ cartItems, setCartItems }) => {
    const [isDropdownOpen, setDropdownOpen] = useState(false);
    const [isModalOpen, setModalOpen] = useState(false);
    const [notes, setNotes] = useState("");
    const [tableId, setTableId] = useState(null);

    // Load tableId from localStorage on component mount
    useEffect(() => {
        const storedTableId = localStorage.getItem("tableId");
        if (storedTableId) {
            setTableId(storedTableId);
        } else {
            console.warn("No table ID found in localStorage!");
        }
    }, []);

    const totalPrice = cartItems.reduce(
        (total, item) => total + item.price * item.quantity,
        0
    );

    const handleAddToCart = (product) => {
        const existingItem = cartItems.find((item) => item.id === product.id);

        if (existingItem) {
            const updatedCart = cartItems.map((item) =>
                item.id === product.id
                    ? { ...item, quantity: item.quantity + 1 }
                    : item
            );
            setCartItems(updatedCart);
            localStorage.setItem("cart", JSON.stringify(updatedCart));
        } else {
            const newCart = [...cartItems, { ...product, quantity: 0 }];
            setCartItems(newCart);
            localStorage.setItem("cart", JSON.stringify(newCart));
        }
    };

    const handleRemoveFromCart = (product) => {
        const existingItem = cartItems.find((item) => item.id === product.id);

        if (existingItem && existingItem.quantity > 1) {
            const updatedCart = cartItems.map((item) =>
                item.id === product.id
                    ? { ...item, quantity: item.quantity - 1 }
                    : item
            );
            setCartItems(updatedCart);
            localStorage.setItem("cart", JSON.stringify(updatedCart));
        } else {
            const updatedCart = cartItems.filter(
                (item) => item.id !== product.id
            );
            setCartItems(updatedCart);
            localStorage.setItem("cart", JSON.stringify(updatedCart));
        }
    };

    const handleFormSubmit = (e) => {
        e.preventDefault();

        const checkoutData = {
            totalAmount: totalPrice,
            orderItems: cartItems.map(({ id, name, price, quantity }) => ({
                id,
                name,
                price,
                quantity,
            })),
            notes,
            tableId,
        };

        console.log("Checkout data:", checkoutData);
        alert("Таны захиалгийг боловсруулж байна...");

        // You can redirect or perform further actions here
        // Example: window.location.href = "/order/checkout";
    };

    return (
        <div className="justify-center w-full">
            {/* Header */}
            <div
                className="w-full rounded-t-lg bg-orange-500 flex justify-between items-center py-2 cursor-pointer"
                onClick={() => setDropdownOpen(!isDropdownOpen)}
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
                        {/* Cart Items */}
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

                        {/* Payment Button */}
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
                            <textarea
                                name="notes"
                                rows="4"
                                className="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none"
                                placeholder="Хэрэв таньд бидэнд мэдэгдэх зүйл байвал заавал бичнэ үү. (Харшилтай, Давс хэрэглэдэггүй гэх мэт)"
                                value={notes}
                                onChange={(e) => setNotes(e.target.value)}
                            ></textarea>
                            <input
                                type="hidden"
                                name="cart_items"
                                value={JSON.stringify(cartItems)}
                            />
                            <input
                                type="hidden"
                                name="table_id"
                                value={tableId || ""}
                            />
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
