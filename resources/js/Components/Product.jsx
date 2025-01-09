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
            handleAddToCart(product); // Add to cart on click
        } else {
            // If a new product is selected, set count to 1
            setSelectedProduct({ ...product, count: 1 });
            handleAddToCart(product); // Add to cart on click
        }
    };

    const isSelected = selectedProduct?.id === product.id;
    const productCount = selectedProduct?.count || 0;

    return (
        <div className="menu-product gap-4">
            <div
                className="menu-product-item bg-gray-100 text-product-high-contrast relative cursor-pointer rounded-lg overflow-hidden shadow-md transition-transform transform hover:shadow-lg"
                style={{ WebkitTapHighlightColor: "transparent" }}
                onClick={() => handleCardClick(product)}
            >
                {/* Product Image */}
                <div className="aspect-square bg-gray-100">
                    <img
                        src={
                            product.thumbnail ||
                            "https://via.placeholder.com/150"
                        }
                        alt={product.name || "Product"}
                        className="w-full h-full object-cover"
                    />
                </div>

                {/* Product Details */}
                <div className="p-2 bg-white">
                    <div className="flex justify-between items-center">
                        <span className="text-sm sm:text-base font-semibold text-gray-700">
                            {product.name || "Unnamed Product"}
                        </span>
                        <span className="text-sm sm:text-base font-semibold text-orange-500">
                            {product.price
                                ? `${product.price}₮`
                                : "Price Unavailable"}
                        </span>
                    </div>
                </div>

                {/* Selected Overlay */}
                {isSelected && (
                    <div className="absolute inset-0 bg-orange-300 bg-opacity-50 flex items-center justify-center">
                        <div className="text-white text-4xl font-bold">
                            {productCount || 1}
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
};

export default Product;
