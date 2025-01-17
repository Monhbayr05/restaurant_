import React from "react";
import popular from "../Components/Images/popular.png";

const Category = ({ categories = [], activeCategory,  setActiveCategory }) => {

    console.log("Categories received:", categories);
    
    const categoryList = [{ name: "All", thumbnail: popular }, ...categories];

    return (
        <section className="categories-section categories-section--medium-photo overflow-x-auto p-1.5 flex space-x-3 mb-6 pb-4 rounded-sm scrollbar">
            <div className="categories-section__container flex flex-nowrap items-stretch">
                {categoryList.map((category, index) => {
                    const name = category.name || "helloworld";
                    const thumbnail = category.thumbnail || "https://via.placeholder.com/80";

                    return (
                        <button
                            key={index}
                            onClick={() => setActiveCategory(name)}
                            aria-label={`Select category ${name}`}
                            className={`flex flex-col items-center space-y-1 px-2 py-2 ${
                                activeCategory === name ? "active" : ""
                            }`}
                        >
                            <div
                                className={`w-16 h-16 flex items-center justify-center rounded-full transition ${
                                    activeCategory === name
                                        ? "bg-orange-500 shadow-lg"
                                        : "bg-gray-200"
                                }`}
                            >
                                <img
                                    src={thumbnail}
                                    alt={name}
                                    className="w-14 h-14 object-cover rounded-full"
                                />
                            </div>
                            <span
                                className={`text-sm font-medium ${
                                    activeCategory === name
                                        ? "text-orange-500"
                                        : "text-gray-600"
                                }`}
                            >
                                {name}
                            </span>
                        </button>
                    );
                })}
            </div>
        </section>
    );
};

export default Category;
