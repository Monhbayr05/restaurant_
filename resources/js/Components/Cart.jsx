import React from "react";

const Cart = ({ cartItems, setCartItems }) => {
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
        <div className="w-full bg-white p-2 rounded-t-lg shadow-lg fixed bottom-0 left-0 flex flex-col">
            <h2 className="text-xl font-bold mb-2 text-center">Миний захиалга</h2>
            <ul className="mb-2 flex-1 overflow-y-auto max-h-40">
                {cartItems.length > 0 ? (
                    cartItems.map((item) => (
                        <li
                            key={item.id}
                            className="mb-2 flex justify-between items-center"
                        >
                            <span className="text-sm">
                                {item.name} - {item.price.toFixed(2)} x{" "}
                                {item.quantity}
                            </span>
                            <div className="flex">
                                <button
                                    onClick={() => handleAddToCart(item)}
                                    className="text-white bg-orange-500 px-2 py-1 rounded-full mx-1"
                                >
                                    +
                                </button>
                                <button
                                    onClick={() => handleRemoveFromCart(item)}
                                    className="text-white bg-red-500 px-2 py-1 rounded-full mx-1"
                                >
                                    -
                                </button>
                            </div>
                        </li>
                    ))
                ) : (
                    <li className="mb-2 text-center">Захиалга хоосон байна.</li>
                )}
            </ul>
            <button
                onClick={handlePayment}
                className="w-full bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600"
                disabled={cartItems.length === 0}
            >
                Төлөх: {totalPrice.toFixed(2)}₮
            </button>
        </div>
    );
};

export default Cart;
