// Product.jsx
import React from 'react';

const Product = ({ product, handleAddToCart }) => {
    return (
        <div className="bg-white rounded shadow-md p-4">
            <img
                src={product.thumbnail || 'https://via.placeholder.com/150'}
                alt={product.name || 'Product'}
                className="w-full h-32 sm:h-48 object-cover rounded mb-4"
            />
            <h3 className="text-sm md:text-lg font-semibold">{product.name}</h3>
            <p className="text-gray-500 text-xs md:text-sm">
                {product.price} ₮
            </p>
            <button
                onClick={() => handleAddToCart(product)}
                className="mt-2 px-4 py-2 bg-orange-500 text-white rounded text-sm md:text-base w-full"
            >
                Add to Cart
            </button>
        </div>
    );
};

export default Product;
