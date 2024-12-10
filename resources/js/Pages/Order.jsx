import React, { useState } from 'react';

const Order = ({ categories, products }) => {
    const [cartItems, setCartItems] = useState(JSON.parse(localStorage.getItem('cart')) || []);
    const [activeCategory, setActiveCategory] = useState('All');

    const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);

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
            totalAmount: total,
            orderItems: cartItems.map(({id, name, price, quantity}) => ({
                id,
                name,
                price,
                quantity,
            })),
        };

        console.log('Payment data:', paymentData);
        alert('Proceeding with payment...');

        window.location.href = '/order/checkout';
    };

    // Category Filtering
    const filteredProducts = activeCategory === 'All'
        ? products
        : products.filter(product => product.category === activeCategory);

    return (
        <div className="p-4 md:p-6 bg-gray-50 min-h-screen">
            {/* Header */}
            <div className="bg-white p-4 shadow-md flex justify-between items-center rounded-md">
                {/* Left Section: Logo and Title */}
                <div className="flex items-center space-x-2">
                    {/* Logo */}
                    <div className="w-8 h-8 flex items-center justify-center">
                        <img
                            src={logoImage} // Replace with your star icon/image URL
                            alt="Logo"
                            className="object-contain w-full h-full"
                        />
                    </div>
                    {/* Title */}
                    <h1 className="text-xl font-bold text-gray-800">FoodBazalt</h1>
                </div>

                {/* Right Section: Language Button */}
                <div>
                    <button className="bg-gray-200 px-4 py-2 rounded-full text-gray-800 text-sm">
                        English
                    </button>
                </div>
            </div>
            {/* End of Header */}

            {/* Search */}
            <div className="flex items-center bg-gray-800 rounded-full px-4 py-2 mt-4 shadow-md">
                {/* Search Icon */}
                <i className="fas fa-search text-gray-400"></i>
                
                {/* Search Input */}
                <input
                    type="text"
                    placeholder="Search your favourites..."
                    className="bg-transparent text-white placeholder-gray-500 ml-4 flex-grow focus:outline-none"
                />
                
                {/* Filter Icon */}
                <button className="ml-4">
                    <i className="fas fa-sliders-h text-gray-400"></i> {/* Replace with an appropriate filter icon */}
                </button>
            </div>


            {/* Section with an Image
            <div className="mt-4 flex justify-center items-center">
                <img
                    src="https://via.placeholder.com/600x300" // Replace with your desired image URL
                    alt="Section Content"
                    className="w-full max-w-4xl object-cover rounded-md"
                />
            </div> */}

            {/* Category Filter */}
            <div className="flex space-x-6 mb-6 overflow-x-auto pb-4 scrollbar">
                {['All', ...categories].map((category, index) => (
                    <button
                        key={index}
                        onClick={() => setActiveCategory(category.name || category)}
                        className={`flex flex-col items-center space-y-2 px-2 py-1 ${
                            activeCategory === (category.name || category)
                                ? 'text-blue-500'
                                : 'text-gray-600'
                        }`}
                    >
                        {/* Icon/Image */}
                        <div
                            className={`w-12 h-12 flex items-center justify-center rounded-full ${
                                activeCategory === (category.name || category) ? 'bg-yellow-300' : 'bg-gray-200'
                            }`}
                        >
                            <img
                                src={category.image || 'https://via.placeholder.com/40'}
                                alt={category.name || 'Category'}
                                className="w-6 h-6 object-contain"
                            />
                        </div>
                        {/* Text */}
                        <span className="text-xs md:text-sm font-medium">
                            {category.name || category}
                        </span>
                    </button>
                ))}
            </div>





            {/* Product List
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
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
            </div> */}

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
                    >
                        Go to checkout
                    </button>
                    <p className="text-sm text-gray-500 mt-2">Min. order $0.00</p>
                    <button className="text-green-500 text-sm underline mt-2">I have a coupon</button>
                </div>
        </div>           
    )
}

export default Order;
