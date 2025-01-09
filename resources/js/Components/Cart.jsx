import React, { useState } from "react";

const Cart = ({ cartItems, setCartItems }) => {
    const [isDropdownOpen, setDropdownOpen] = useState(false); // State for toggling dropdown visibility
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
            const newCart = [...cartItems, { ...product, quantity: 1 }];
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

    const handlePayment = () => {
        const paymentData = {
            totalAmount: totalPrice,
            orderItems: cartItems.map(({ id, name, price, quantity }) => ({
                id,
                name,
                price,
                quantity,
            })),
        };

        console.log("Payment data:", paymentData);
        alert("Proceeding with payment...");

        window.location.href = "/order/checkout";
    };

    return (
        <div className="justify-center w-full">
            <div
                className="w-full rounded-t-lg bg-orange-500 flex justify-between items-center py-2"
                onClick={() => setDropdownOpen(!isDropdownOpen)}
            >
                {/* Clickable Header for Dropdown */}
                <h2 className="px-2 text-l font-bold text-white cursor-pointer">
                    Миний захиалга
                </h2>
                <h2 className="px-2 text-l font-bold text-white">
                    Нийт: {totalPrice} ₮
                </h2>
            </div>
            {/* Dropdown Content */}
            {isDropdownOpen && (
                <div className="bg-white w-full flex justify-center">
                    <div className="w-full max-w-[300px] bg-white rounded-lg overflow-hidden">
                        <ul className="max-h-40 overflow-y-auto">
                            {cartItems.length > 0 ? (
                                cartItems.map((item) => (
                                    <li
                                        key={item.id}
                                        className="mb-4 flex justify-between items-center"
                                    >
                                        <img
                                            src={item.thumbnail}
                                            alt=""
                                            className="w-[40px] h-[40px] object-cover"
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
                        <div className="pt-1">
                            <button
                                onClick={handlePayment}
                                className="w-full bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600"
                                disabled={cartItems.length === 0}
                            >
                                Төлөх: {totalPrice.toFixed(2)}₮
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
};

export default Cart;
