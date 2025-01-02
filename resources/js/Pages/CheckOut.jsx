import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";

const Checkout = () => {
  const [cartItems, setCartItems] = useState([]);
  const [tableId, setTableId] = useState("");
  const [restaurantId, setRestaurantId] = useState("");
  const [total, setTotal] = useState(0);


  useEffect(() => {
    const storedCartItems = JSON.parse(localStorage.getItem("cart")) || [];
    const storedTableId = localStorage.getItem("tableId");
    const storedRestaurantId = localStorage.getItem("restaurantId");

    setCartItems(storedCartItems);
    setTableId(storedTableId || "");
    setRestaurantId(storedRestaurantId || "");


    const totalAmount = storedCartItems.reduce(
      (sum, item) => sum + item.price * item.quantity,
      0
    );
    setTotal(totalAmount);
  }, []);

  return (
    <div className="min-h-screen bg-gray-100 py-8">
      <form
        action="/order/store"
        method="POST"
        className="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6"
      >
        <input type="hidden" name="_token" value="csrf_token_here" />
        <input
          type="hidden"
          name="cart_items"
          value={JSON.stringify(cartItems)}
        />
        <input type="hidden" name="table_id" value={tableId} />
        <input type="hidden" name="restaurant_id" value={restaurantId} />

        {/* Title */}
        <h1 className="text-2xl font-bold text-gray-800 mb-6 text-center">
          Food Bazalt
        </h1>

        {/* User Information Form */}
        <div className="space-y-4">
          <div className="flex flex-col">
            <label
              htmlFor="name"
              className="text-gray-600 font-medium mb-2"
            >
              Нэр
            </label>
            <input
              type="text"
              name="name"
              required
              className="p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"
            />
          </div>

          <div className="flex flex-col">
            <label
              htmlFor="phone"
              className="text-gray-600 font-medium mb-2"
            >
              Утасны дугаар
            </label>
            <input
              type="number"
              name="phone"
              required
              className="p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"
            />
          </div>

          <div className="flex flex-col">
            <label
              htmlFor="email"
              className="text-gray-600 font-medium mb-2"
            >
              И-мэйл хаяг
            </label>
            <input
              type="text"
              name="email"
              required
              className="p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"
            />
          </div>

          <div className="flex flex-col">
            <label
              htmlFor="notes"
              className="text-gray-600 font-medium mb-2"
            >
              Харшилтай эсэх
            </label>
            <textarea
              name="notes"
              rows="4"
              required
              className="p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"
            ></textarea>
          </div>
        </div>

        {/* Cart Display */}
        <div className="mt-8">
          <h2 className="text-xl font-bold text-gray-800 mb-4">My Cart</h2>
          <div className="space-y-4">
            {cartItems.length > 0 ? (
              cartItems.map((item, index) => (
                <div
                  key={index}
                  className="flex justify-between items-center bg-gray-100 p-4 rounded-md"
                >
                  <div>
                    <h4 className="text-lg font-semibold">{item.name}</h4>
                    <p className="text-sm text-gray-600">
                      {item.price.toFixed(2)}₮ x {item.quantity}
                    </p>
                  </div>
                  <div className="text-lg font-bold text-gray-800">
                    {(item.price * item.quantity).toFixed(2)}₮
                  </div>
                </div>
              ))
            ) : (
              <p className="text-gray-600 text-center">
                Таны сагс хоосон байна.
              </p>
            )}
          </div>
          <div className="mt-6 flex justify-between items-center border-t pt-4">
            <span className="text-lg font-bold text-gray-800">Нийт:</span>
            <span className="text-lg font-bold text-orange-600">
              {total.toFixed(2)}₮
            </span>
          </div>
        </div>

        {/* Submit Button */}
        <div className="mt-8 text-center">
          <button
            type="submit"
            className="w-full bg-orange-500 text-white py-2 rounded-md hover:bg-orange-600 transition duration-300"
          >
            Захиалах
          </button>
        </div>
      </form>
    </div>
  );
};

export default Checkout;
