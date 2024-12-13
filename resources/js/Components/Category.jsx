// Category.jsx
import React from 'react';

const Category = ({ categories, activeCategory, setActiveCategory }) => {
    return (
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
                    <div
                        className={`w-12 h-12 flex items-center justify-center rounded-full ${
                            activeCategory === (category.name || category)
                                ? 'bg-yellow-300'
                                : 'bg-gray-200'
                        }`}
                    >
                        <img
                            src={category.image || 'https://via.placeholder.com/40'}
                            alt={category.name || 'Category'}
                            className="w-6 h-6 object-contain"
                        />
                    </div>
                    <span className="text-xs md:text-sm font-medium">
                        {category.name || category}
                    </span>
                </button>
            ))}
        </div>
    );
};

export default Category;
