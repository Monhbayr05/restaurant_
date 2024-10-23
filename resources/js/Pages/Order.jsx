import React from 'react';

const categories = [
  'Appetizers',
  'Soups',
  'Main courses',
  'Pizza',
  'Desserts',
  'Drinks',
];

const products = [
  { id: 1, name: 'Soup 1', volume: '450ml', price: 5.00, badge: 'Bestseller' },
  { id: 2, name: 'Soup 2', volume: '450ml', price: 5.00, badge: 'Gluten' },
  { id: 3, name: 'Soup 3', volume: '450ml', price: 5.00, badge: 'Bestseller' },
];

const Order = () => {
  const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

  const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);

  const handlePayment = () => {
    const paymentData = {
      totalAmount: total,
      orderItems: cartItems.map(({ id, name, price, quantity }) => ({
        id,
        name,
        price,
        quantity,
      })),
    };

    console.log('Payment data:', paymentData);
    alert('Proceeding with payment...');
  };

  return (
    <div className="min-h-screen bg-gray-50 p-6">
      {/* Category Selection */}
      <div className="flex justify-center mb-6">
        {categories.map((category, index) => (
          <button key={index} className="px-4 py-2 bg-gray-100 rounded-full mx-2 text-gray-800 hover:bg-green-200 focus:bg-green-400">
            {category}
          </button>
        ))}
      </div>

      <div className="flex justify-between">
        {/* Product Grid */}
        <div className="grid grid-cols-3 gap-6">
          {products.map((product) => (
            <div key={product.id} className="border rounded-lg p-4 shadow-md text-center hover:shadow-lg transition">
              <div className="h-32 bg-gray-100 mb-4">
                <img src="https://via.placeholder.com/150" alt={product.name} className="w-full h-full object-cover" />
              </div>
              <h3 className="font-bold mb-2">{product.name} ({product.volume})</h3>
              <span className="inline-block mb-2 text-sm text-gray-500">{product.badge}</span>
              <p className="text-lg font-semibold mb-4">${product.price.toFixed(2)}</p>
              <button className="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600">
                Add
              </button>
            </div>
          ))}
        </div>

        {/* Cart Summary */}
        <div className="w-64 bg-white p-6 rounded-lg shadow-md">
          <h2 className="text-xl font-bold mb-4">Your order</h2>
          <ul className="mb-4">
            {cartItems.map((item) => (
              <li key={item.id} className="mb-2">
                {item.name} - ${item.price.toFixed(2)} x {item.quantity}
              </li>
            ))}
          </ul>
          <p className="font-bold text-lg mb-4">Total: ${total.toFixed(2)}</p>
          <button
            onClick={handlePayment}
            className="w-full bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600"
          >
            Go to checkout
          </button>
          <p className="text-sm text-gray-500 mt-2">Min. order $0.00</p>
          <button className="text-green-500 text-sm underline mt-2">I have a coupon</button>
        </div>
      </div>
    </div>
  );
};

export default Order;
