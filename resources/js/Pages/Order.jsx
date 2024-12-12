import React, { useState, useEffect } from 'react';

const Order = ({ categories, products }) => {
    const [cartItems, setCartItems] = useState(JSON.parse(localStorage.getItem('cart')) || []);
    const [activeCategory, setActiveCategory] = useState('All');
    const [tableId, setTableId] = useState(localStorage.getItem('tableId') || ''); // LocalStorage-оос tableId-г унших

    const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);

    useEffect(() => {
        // tableId-ийн утгыг LocalStorage-д хадгалах
        localStorage.setItem('tableId', tableId);
    }, [tableId]); // tableId өөрчлөгдөх бүрд хадгална

    const handleAddToCart = (product) => {
        const existingItem = cartItems.find(item => item.id === product.id);

        if (existingItem) {
            const updatedCart = cartItems.map(item =>
                item.id === product.id ? { ...item, quantity: item.quantity + 1 } : item
            );
            setCartItems(updatedCart);
            localStorage.setItem('cart', JSON.stringify(updatedCart));
        } else {
            const newCart = [...cartItems, { ...product, quantity: 1 }];
            setCartItems(newCart);
            localStorage.setItem('cart', JSON.stringify(newCart));
        }
    };

    const handleRemoveFromCart = (product) => {
        const existingItem = cartItems.find(item => item.id === product.id);

        if (existingItem && existingItem.quantity > 1) {
            const updatedCart = cartItems.map(item =>
                item.id === product.id ? { ...item, quantity: item.quantity - 1 } : item
            );
            setCartItems(updatedCart);
            localStorage.setItem('cart', JSON.stringify(updatedCart));
        } else {
            const updatedCart = cartItems.filter(item => item.id !== product.id);
            setCartItems(updatedCart);
            localStorage.setItem('cart', JSON.stringify(updatedCart));
        }
    };

    const handlePayment = () => {
        const paymentData = {
            tableId,
            totalAmount: total,
            orderItems: cartItems.map(({ id, name, price, quantity }) => ({
                id,
                name,
                price,
                quantity,
            })),
        };

        console.log('Payment data:', paymentData);
        alert(`Proceeding with payment for table ${tableId}...`);

        window.location.href = '/order/checkout';
    };

    const filteredProducts = activeCategory === 'All'
        ? products
        : products.filter(product => product.category === activeCategory);

    return (
        <div className="p-4 md:p-6 bg-gray-50 min-h-screen">
            {/* Input for Table ID */}
            <div className="mb-6">
                <label htmlFor="tableId" className="block text-sm font-medium text-gray-700">
                    Enter Table ID
                </label>
                <input
                    type="text"
                    id="tableId"
                    value={tableId}
                    onChange={(e) => setTableId(e.target.value)} // State болон LocalStorage-д хадгална
                    placeholder="Table ID"
                    className="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                />
            </div>

            {/* Product List */}
            <div className="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 md:gap-6">
                {filteredProducts.map((product) => (
                    <div key={product.id} className="bg-white rounded shadow-md p-4">
                        <img
                            src={product.thumbnail || 'https://via.placeholder.com/150'}
                            alt={product.name || 'Product'}
                            className="w-full h-32 sm:h-48 object-cover rounded mb-4"
                        />
                        <h3 className="text-sm md:text-lg font-semibold">{product.name}</h3>
                        <p className="text-gray-500 text-xs md:text-sm">£{product.price.toFixed(2)}</p>
                        <button
                            onClick={() => handleAddToCart(product)}
                            className="mt-2 px-4 py-2 bg-green-500 text-white rounded text-sm md:text-base w-full"
                        >
                            Add to Cart
                        </button>
                    </div>
                ))}
            </div>

            {/* Cart Summary */}
            <div className="w-64 bg-white p-6 rounded-lg shadow-md">
                <h2 className="text-xl font-bold mb-4">Your order</h2>
                <ul className="mb-4">
                    {cartItems.map((item) => (
                        <li key={item.id} className="mb-2 flex justify-between items-center">
                            <span>{item.name} - {item.price.toFixed(2)} x {item.quantity}</span>
                            <div className="flex">
                                <button
                                    onClick={() => handleAddToCart(item)}
                                    className="text-white bg-green-500 px-2 py-1 rounded-full mx-1"
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
                    ))}
                </ul>
                <p className="font-bold text-lg mb-4">Total: {total.toFixed(2)}₮</p>
                <button
                    onClick={handlePayment}
                    className="w-full bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600"
                    disabled={!tableId} // Хэрэв tableId хоосон бол төлбөрийн товчийг идэвхгүй болгоно
                >
                    Go to checkout
                </button>
            </div>
        </div>
    );
};

export default Order;
