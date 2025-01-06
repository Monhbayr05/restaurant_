// Category.jsx
import React from "react";

const Category = ({ categories, activeCategory, setActiveCategory }) => {
    return (
        <div className="flex space-x-3 mb-6 overflow-x-auto pb-4 scrollbar overflow:vsisble rounded-sm">
            {["All", ...categories].map((category, index) => (
                <button
                    key={index}
                    onClick={() => setActiveCategory(category)}
                    className={`flex flex-col items-center space-y-1 px-1 py-1 ${
                        activeCategory === category ? "active" : ""
                    }`}
                >
                    <div
                        className={`w-16 h-16 flex items-center justify-center rounded-full ${
                            activeCategory === category
                                ? "bg-orange-500"
                                : "bg-gray-200"
                        }`}
                    >
                        <img
                            src={
                                category.thumbnail ||
                                "https://via.placeholder.com/80"
                            }
                            alt={category.name || "Category"}
                            className="w-16 h-16 object-cover rounded-full"
                        />
                    </div>
                    <span
                        className={`text-sm font-medium ${
                            activeCategory === category
                                ? "text-orange-500"
                                : "text-gray-600"
                        }`}
                    >
                        {category.name || "All"}
                    </span>
                </button>
            ))}
        </div>
    );
};

export default Category;
