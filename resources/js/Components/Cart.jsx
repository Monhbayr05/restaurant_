import React from 'react';

const Cart = ({ cartItems, setCartItems }) => {
  const handleRemove = (id) => {
    setCartItems((prevItems) =>
      prevItems.filter((item) => item.id !== id)
    );
  };

  const totalPrice = cartItems.reduce((total, item) => total + item.price * item.quantity, 0);

  return (
    <div className="w-1/3 bg-white p-5 rounded-lg shadow-md">
      <h2 className="text-xl font-bold mb-4">Your order</h2>
      {cartItems.length === 0 ? (
        <p className="text-gray-600">Your cart is empty. Add menu items.</p>
      ) : (
        <ul>
          {cartItems.map((item) => (
            <li key={item.id} className="flex justify-between items-center my-2">
              <span>{item.name} x {item.quantity}</span>
              <button 
                onClick={() => handleRemove(item.id)}
                className="text-red-500 hover:text-red-700">
                Remove
              </button>
            </li>
          ))}
        </ul>
      )}
      <p className="font-semibold text-lg mt-4">Total: ${totalPrice.toFixed(2)}</p>
      <button 
        className="bg-[#F7DC69] w-full mt-4 py-2 rounded-md font-semibold"
        disabled={cartItems.length === 0}>
        Go to checkout
      </button>
    </div>
  );
};

export default Cart;
