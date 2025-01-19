import React, { useState } from "react";
import { Link } from "@inertiajs/react";

const Cart = ({ cartItems, setCartItems }) => {
  const [isDropdownOpen, setDropdownOpen] = useState(false);

  // Make sure you have table_id if required
  const [table_id, setTableId] = useState(
    localStorage.getItem("table_id") || null
  );

  // Calculate total price
  const totalPrice = cartItems.reduce(
    (total, item) => total + item.price * item.quantity,
    0
  );

  // Add product to cart
  const handleAddToCart = (product) => {
    const existingItem = cartItems.find((item) => item.id === product.id);

    const updatedCart = existingItem
      ? cartItems.map((item) =>
          item.id === product.id
            ? { ...item, quantity: item.quantity + 1 }
            : item
        )
      : [...cartItems, { ...product, quantity: 1 }];

    setCartItems(updatedCart);
    localStorage.setItem("cart", JSON.stringify(updatedCart));
  };

  // Remove or decrement product from cart
  const handleRemoveFromCart = (product) => {
    const existingItem = cartItems.find((item) => item.id === product.id);

    const updatedCart =
      existingItem.quantity > 1
        ? cartItems.map((item) =>
            item.id === product.id
              ? { ...item, quantity: item.quantity - 1 }
              : item
          )
        : cartItems.filter((item) => item.id !== product.id);

    setCartItems(updatedCart);
    localStorage.setItem("cart", JSON.stringify(updatedCart));
  };

  return (
    <div className="justify-center w-full">
      {/* Header */}
      <div
        className="w-full rounded-t-lg bg-orange-500 flex justify-between items-center py-2 cursor-pointer"
        onClick={() => setDropdownOpen(!isDropdownOpen)}
        aria-expanded={isDropdownOpen}
      >
        <h2 className="px-2 text-lg font-bold text-white">
          Миний захиалга
        </h2>
        <h2 className="px-2 text-lg font-bold text-white">
          Нийт: {totalPrice.toFixed(2)} ₮
        </h2>
      </div>

      {/* Dropdown */}
      {isDropdownOpen && (
        <div className="bg-white w-full flex justify-center">
          <div className="w-full max-w-[300px] bg-white rounded-lg shadow-lg p-4">
            <ul className="max-h-40 overflow-y-auto mb-4">
              {cartItems.length > 0 ? (
                cartItems.map((item) => (
                  <li
                    key={item.id}
                    className="mb-4 flex justify-between items-center"
                  >
                    <img
                      src={item.thumbnail}
                      alt={item.name}
                      className="w-[40px] h-[40px] object-cover rounded"
                    />
                    <span className="text-sm">
                      {item.name} - {item.price.toFixed(2)}₮ x {item.quantity}
                    </span>
                    <div className="flex space-x-2">
                      <button
                        onClick={() => handleAddToCart(item)}
                        className="text-white bg-orange-500 px-2 py-1 rounded-full hover:bg-orange-600"
                      >
                        +
                      </button>
                      <button
                        onClick={() => handleRemoveFromCart(item)}
                        className="text-white bg-red-500 px-2 py-1 rounded-full hover:bg-red-600"
                      >
                        -
                      </button>
                    </div>
                  </li>
                ))
              ) : (
                <li className="text-center text-gray-500">
                  Захиалга хоосон байна.
                </li>
              )}
            </ul>
            <Link
              href={route("order.checkout")}
              className="flex justify-center w-full bg-orange-500 text-white px-4 py-2 mt-4 rounded-lg hover:bg-orange-600"
              disabled={cartItems.length === 0}
            >
              Төлөх: {totalPrice.toFixed(2)}₮
            </Link>
          </div>
        </div>
      )}
    </div>
  );
};

export default Cart;
