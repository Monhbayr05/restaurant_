import React, { useState, useEffect } from "react";
import Cart from "../Components/Cart.jsx";
import Product from "../Components/Product.jsx";
import Category from "../Components/Category.jsx";
import Header from "@/Components/Header";
import "../Components/css/order.css";

const Order = ({ categories = [], products = [], tableId = "tableId" }) => {
    const [cartItems, setCartItems] = useState(
        JSON.parse(localStorage.getItem("cart")) || []
    );
    const [activeCategory, setActiveCategory] = useState("All");

    // Debugging to verify incoming props
    useEffect(() => {
        console.log("Categories:", categories);
        console.log("Products:", products);
    }, [categories, products]);

    // Update localStorage with tableId and clear cart if tableId changes
    useEffect(() => {
        if (tableId) {
            if (tableId !== localStorage.getItem("tableId")) {
                localStorage.removeItem("cart");
                setCartItems([]);
            }
            localStorage.setItem("tableId", tableId);
        }
    }, [tableId]);

    // Update cart in localStorage whenever it changes
    useEffect(() => {
        const updatedCartItems = cartItems.map((item) =>
            item.food_status === undefined ? { ...item, food_status: 0 } : item
        );
        if (JSON.stringify(updatedCartItems) !== JSON.stringify(cartItems)) {
            setCartItems(updatedCartItems);
            localStorage.setItem("cart", JSON.stringify(updatedCartItems));
        }
    }, [cartItems]);

    // Add product to cart logic
    const handleAddToCart = (product) => {
        const existingItem = cartItems.find((item) => item.id === product.id);
        const tableId = Number(localStorage.getItem("tableId")) || 0;

        if (existingItem) {
            if (existingItem.quantity < product.quantity_limit) {
                const updatedCart = cartItems.map((item) =>
                    item.id === product.id
                        ? { ...item, quantity: item.quantity + 1, tableId }
                        : item
                );
                setCartItems(updatedCart);
                localStorage.setItem("cart", JSON.stringify(updatedCart));
            } else {
                alert(
                    `You can only add up to ${product.quantity_limit} of this item.`
                );
            }
        } else {
            if (product.quantity_limit > 0) {
                const newCart = [
                    ...cartItems,
                    { ...product, quantity: 1, tableId, food_status: 0 },
                ];
                setCartItems(newCart);
                localStorage.setItem("cart", JSON.stringify(newCart));
            } else {
                alert(
                    `You can only add up to ${product.quantity_limit} of this item.`
                );
            }
        }
    };

    const filteredProducts = Array.isArray(products)
        ? activeCategory === "All"
            ? products
            : products.filter(
                  (product) => product.category?.name === activeCategory
              )
        : [];
    // Debugging filtered products
    useEffect(() => {
        console.log("Active Category:", activeCategory);
        console.log("Filtered Products:", filteredProducts);
    }, [activeCategory, filteredProducts]);

    if (!categories.length || !Array.isArray(products)) {
        return (
            <div
                id="menu-page"
                className="min-h-screen flex flex-col  top-0 bg-white"
            >
                <header
                    id="sticky-header"
                    className="transition-transform duration-1000 ease bg-ik-header-bg-color text-ik-header-bg-high-contrast-color"
                >
                    <Header />
                </header>

                <section className="menu-content--categories-medium-photo menu-content overflow-y-auto mb-20">
                    <div className="p-[10px]">
                        <div className="menu-grid grid grid-cols-2 gap-y-[10px] gap-x-[5px]">
                            <div className="col-span-full text-center text-gray-500 py-6">
                                <p className="text-lg font-semibold">
                                    Бүтээгдэхүүн байхгүй байна.
                                </p>
                                <p className="text-sm">
                                    Админ шалгаж дуустал түр хүлээнэ үү.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        );
    }

    return (
        <div
            id="menu-page"
            className="min-h-screen flex flex-col  top-0 bg-white"
        >
            <header
                id="sticky-header"
                className="transition-transform duration-1000 ease bg-ik-header-bg-color text-ik-header-bg-high-contrast-color"
            >
                <Header />
                {/* Category Filter */}
                <Category
                    categories={categories}
                    activeCategory={activeCategory}
                    setActiveCategory={setActiveCategory}
                />
            </header>

            {/* Product List */}
            <section className="menu-content--categories-medium-photo menu-content overflow-y-auto mb-20">
                <div className="p-[10px]">
                    <div className="menu-grid grid grid-cols-2 gap-y-[10px] gap-x-[5px]">
                        {filteredProducts.length > 0 ? (
                            filteredProducts.map((product) => (
                                <article
                                    key={product.id}
                                    className="w-full h-full"
                                >
                                    <Product
                                        product={product}
                                        handleAddToCart={handleAddToCart}
                                    />
                                </article>
                            ))
                        ) : (
                            <div className="col-span-full text-center text-gray-500 py-6">
                                <p className="text-lg font-semibold">
                                    Бүтээгдэхүүн байхгүй байна.
                                </p>
                                <p className="text-sm">
                                    Админ шалгаж дуустал түр хүлээнэ үү.
                                </p>
                            </div>
                        )}
                    </div>
                </div>
            </section>

            {/* Cart Section */}
            <div className="w-full bg-white text-black fixed bottom-0 left-0">
                <Cart cartItems={cartItems} setCartItems={setCartItems} />
            </div>
        </div>
    );
};

export default Order;
