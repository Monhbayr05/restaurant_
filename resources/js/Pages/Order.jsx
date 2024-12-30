import React, { useState, useEffect } from 'react';
import logoImage from '../Components/logo.png';
import Cart from '../Components/Cart.jsx';
import Product from '../Components/Product.jsx';
import Category from '../Components/Category.jsx';

const Order = ({ categories = [], products = [], table = [], tableId = 'tableId'}) => {
    const [cartItems, setCartItems] = useState(
        JSON.parse(localStorage.getItem('cart')) || []
    );
    const [activeCategory, setActiveCategory] = useState('All');

    // Table ID-ийг localStorage-оос авах
    useEffect(() => {
        if (tableId) {
            if (tableId !== localStorage.getItem('tableId')) {
                // Шинэ QR код уншигдсан тул localStorage-г цэвэрлэх
                localStorage.removeItem('cart');
                setCartItems([]);
            }
            localStorage.setItem('tableId', tableId); // Хадгалах үед string болж хадгалагдана
        }
    }, [tableId]);

    useEffect(() => {
        const updatedCartItems = cartItems.map((item) => (
            item.food_status === undefined ? { ...item, food_status: 0 } : item
        ));
        if (JSON.stringify(updatedCartItems) !== JSON.stringify(cartItems)) {
            setCartItems(updatedCartItems);
            localStorage.setItem('cart', JSON.stringify(updatedCartItems));
        }
    }, [cartItems]);

    const handleAddToCart = (product) => {
        const existingItem = cartItems.find((item) => item.id === product.id);
        const tableId = Number(localStorage.getItem('tableId')) || 0;

        if (existingItem) {
            if (existingItem.quantity < product.quantity_limit) {
                const updatedCart = cartItems.map((item) =>
                    item.id === product.id
                        ? { ...item, quantity: item.quantity + 1, tableId }
                        : item
                );
                setCartItems(updatedCart);
                localStorage.setItem('cart', JSON.stringify(updatedCart));
            } else {
                alert(`You can only add up to ${product.quantity_limit} of this item.`);
            }
        } else {
            if (product.quantity_limit > 0) {
                const newCart = [...cartItems, { ...product, quantity: 1, tableId, food_status: 0 }];
                setCartItems(newCart);
                localStorage.setItem('cart', JSON.stringify(newCart));
            } else {
                alert(`You can only add up to ${product.quantity_limit} of this item.`);
            }
        }
    };


    const handleCompleteOrder = () => {
        // Захиалгыг дуусгах логик (API руу илгээх эсвэл сервертэй холбогдох)
        // Амжилттай бол localStorage-г цэвэрлэх
        localStorage.removeItem('cart');
        localStorage.removeItem('tableId');
        setCartItems([]);
    };

    // Category-ийг сонгох логик
    const filteredProducts = Array.isArray(products)
        ? (activeCategory === 'All'
            ? products
            : products.filter((product) => product.category === activeCategory))
        : [];

    if (!table || !Array.isArray(products)) {
        return (
            <div className="p-4 md:p-6 bg-slate-950 min-h-screen text-white text-center">
                <h1 className="text-2xl font-bold">Error: Data not loaded</h1>
                <p>Please reload the page or contact support.</p>
            </div>
        );
    }

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
                    <div className="col-span-full text-center text-white">
                        No products available.
                    </div>
                )}
            </div>

            {/* Cart Component */}
            <Cart cartItems={cartItems} setCartItems={setCartItems} />

            {/*/!* Complete Order Button *!/*/}
            {/*<div className="mt-6 text-center">*/}
            {/*    <button*/}
            {/*        className="bg-green-500 px-4 py-2 rounded-full text-white font-bold"*/}
            {/*        onClick={handleCompleteOrder}*/}
            {/*    >*/}
            {/*        Complete Order*/}
            {/*    </button>*/}
            {/*</div>*/}
        </div>
    );
};

export default Order;
