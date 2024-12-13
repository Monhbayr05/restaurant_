import React from 'react';

const Cart = ({ cartItems, setCartItems }) => {
  const totalPrice = cartItems.reduce(
    (total, item) => total + item.price * item.quantity,
    0
  );

  const handleAddToCart = (product) => {
    const existingItem = cartItems.find((item) => item.id === product.id);

    if (existingItem) {
      const updatedCart = cartItems.map((item) =>
        item.id === product.id
          ? { ...item, quantity: item.quantity + 1 }
          : item
      );
      setCartItems(updatedCart);
      localStorage.setItem('cart', JSON.stringify(updatedCart));
    } else {
      const newCart = [...cartItems, { ...product, quantity: 1 }];
      setCartItems(newCart);
      localStorage.setItem('cart', JSON.stringify(newCart));
    }
  };

  const handleRemoveFromCart = (product) => {
    const existingItem = cartItems.find((item) => item.id === product.id);

    if (existingItem && existingItem.quantity > 1) {
      const updatedCart = cartItems.map((item) =>
        item.id === product.id
          ? { ...item, quantity: item.quantity - 1 }
          : item
      );
      setCartItems(updatedCart);
      localStorage.setItem('cart', JSON.stringify(updatedCart));
    } else {
      const updatedCart = cartItems.filter((item) => item.id !== product.id);
      setCartItems(updatedCart);
      localStorage.setItem('cart', JSON.stringify(updatedCart));
    }
  };

  const handlePayment = () => {
    const paymentData = {
      totalAmount: totalPrice,
      orderItems: cartItems.map(({ id, name, price, quantity }) => ({
        id,
        name,
        price,
        quantity,
      })),
    };

    console.log('Payment data:', paymentData);
    alert('Proceeding with payment...');

    window.location.href = '/order/checkout';
  };

  return (
    <div className="w-64 bg-white p-6 rounded-lg shadow-md">
      <h2 className="text-xl font-bold mb-4">Your order</h2>
      <ul className="mb-4">
        {cartItems.map((item) => (
          <li key={item.id} className="mb-2 flex justify-between items-center">
            <span>
              {item.name} - {item.price.toFixed(2)} x {item.quantity}
            </span>
            <div className="flex">
              <button
                onClick={() => handleAddToCart(item)}
                className="text-white bg-green-500 px-2 py-1 rounded-full mx-1"
              >
                +
              </button>
              <button
                onClick={() => handleRemoveFromCart(item)}
                className="text-white bg-red-500 px-2 py-1 rounded-full mx-1"
              >
                -
              </button>
            </div>
          </li>
        ))}
      </ul>
      <p className="font-bold text-lg mb-4">
        Total: {totalPrice.toFixed(2)}₮
      </p>
      <button
        onClick={handlePayment}
        className="w-full bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600"
      >
        Go to checkout
      </button>
      <p className="text-sm text-gray-500 mt-2">Min. order $0.00</p>
      <button className="text-green-500 text-sm underline mt-2">
        I have a coupon
      </button>
    </div>
  );
};

export default Cart;
