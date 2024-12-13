import React, { useState, useEffect } from 'react';
import logoImage from '../Components/logo.png';
import Cart from '../Components/Cart.jsx';
import Product from '../Components/Product.jsx';
import Category from '../Components/Category.jsx';

const Order = ({ categories = [], products = [], table = null }) => {
    const [cartItems, setCartItems] = useState(() => {
        try {
            return JSON.parse(localStorage.getItem('cart')) || [];
        } catch {
            return [];
        }
    });
    const [activeCategory, setActiveCategory] = useState('All');
    const tableId = table?.id || localStorage.getItem('tableId') || '';

    const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);

    useEffect(() => {
        if (table?.id) {
            localStorage.setItem('tableId', table.id);
        }
    }, [table]);

    const handleAddToCart = (product) => {
        const existingItem = cartItems.find((item) => item.id === product.id);

        if (existingItem) {
            const updatedCart = cartItems.map((item) =>
                item.id === product.id
                    ? { ...item, quantity: item.quantity + 1 }
                    : item
            );
            setCartItems(updatedCart);
            localStorage.setItem('cart', JSON.stringify(updatedCart));
        } else {
            const newCart = [...cartItems, { ...product, quantity: 1 }];
            setCartItems(newCart);
            localStorage.setItem('cart', JSON.stringify(newCart));
        }
    };

    const filteredProducts = activeCategory === 'All'
        ? products || []
        : (products || []).filter((product) => product.category === activeCategory);

    return (
        <div className="p-4 md:p-6 bg-slate-950 min-h-screen">
            {/* Header */}
            <div className="bg-white p-4 shadow-md flex justify-between items-center rounded-md">
                <div className="flex items-center space-x-2">
                    <div className="w-8 h-8 flex items-center justify-center">
                        <img
                            src={logoImage}
                            alt="Logo"
                            className="object-contain w-full h-full"
                        />
                    </div>
                    <h1 className="text-xl font-bold text-gray-800">FoodBazalt</h1>
                </div>
                <button className="bg-gray-200 px-4 py-2 rounded-full text-gray-800 text-sm">
                    English
                </button>
            </div>

            {/* Display Table Info */}
            {table && (
                <div className="my-4 bg-gray-800 text-white p-4 rounded-md shadow-md">
                    <h2 className="text-lg font-bold">Table: {table.name}</h2>
                    <p className="text-sm">Restaurant: {table.restaurant_id}</p>
                </div>
            )}

            {/* Category Filter */}
            <Category
                categories={categories}
                activeCategory={activeCategory}
                setActiveCategory={setActiveCategory}
            />

            {/* Product List */}
            <div className="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 md:gap-6">
                {filteredProducts.length > 0 ? (
                    filteredProducts.map((product) => (
                        <Product
                            key={product.id}
                            product={product}
                            handleAddToCart={handleAddToCart}
                        />
                    ))
                ) : (
                    <p className="text-white text-center col-span-3">No products available</p>
                )}
            </div>

            {/* Cart Component */}
            <Cart cartItems={cartItems} setCartItems={setCartItems} />
        </div>
    );
};

export default Order;
