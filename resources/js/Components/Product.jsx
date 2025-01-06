import React, { useState } from "react";

const Product = ({ product, handleAddToCart, handleRemoveFromCart }) => {
    const [selectedProduct, setSelectedProduct] = useState(null);

    // Handle clicking on the product card
    const handleCardClick = (product) => {
        if (selectedProduct?.id === product.id) {
            // If the same product is clicked again, increase the count
            setSelectedProduct((prevState) => ({
                ...prevState,
                count: prevState.count + 1,
            }));
        } else {
            // If a new product is selected, set count to 1
            setSelectedProduct({ ...product, count: 1 });
        }

        // Trigger handleAddToCart to add the item to the cart
        handleAddToCart(product);
    };

    

    const isSelected = selectedProduct?.id === product.id;
    const productCount = selectedProduct?.count || 0;

    return (
        <div
            className={`relative bg-white rounded-md shadow-md overflow-hidden cursor-pointer transition-transform transform ${
                isSelected ? "scale-105 shadow-lg" : "hover:shadow-lg"
            }`}
            onClick={() => handleCardClick(product)}
        >
            {/* Image */}
            <img
                src={product.thumbnail || "https://via.placeholder.com/150"}
                alt={product.name || "Product"}
                className="w-full h-40 sm:h-48 object-cover"
            />

            {/* Price (Top-Left) */}
            <div className="absolute top-2 left-2 bg-black bg-opacity-50 text-white text-sm sm:text-base font-semibold px-2 py-1 rounded">
                {product.price} ₮
            </div>

            {/* Name (Bottom-Left) */}
            <div className="absolute bottom-2 left-2 bg-black bg-opacity-50 text-white text-sm sm:text-base font-semibold px-2 py-1 rounded">
                {product.name}
            </div>

            {/* Selected Overlay */}
            {isSelected && (
                <div className="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <span className="text-white text-4xl font-bold">{productCount}</span>
                </div>
            )}
        </div>
    );
};

export default Product;
