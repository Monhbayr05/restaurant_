import React from 'react';
import ProductCard from './ProductCard';
import Cart from './Cart';


const MenuLayout = ({ products, cartItems, addToCart }) => {
  const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);


  return (
    <div className="container mx-auto px-4 py-6">
      <div className="flex flex-col items-center mb-6">
        <h1 className="text-3xl font-bold text-center">Nice Fries</h1>
      </div>
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
        {/* Product List */}
        <div className="products grid grid-cols-1 gap-4">
          {products.map((product) => (
            <ProductCard key={product.id} product={product} addToCart={addToCart} />
          ))}
        </div>

        {/* Order Summary */}
        <div className="order-summary col-span-1 md:col-span-2 bg-gray-100 p-4 rounded shadow">
          <h2 className="text-xl font-semibold mb-4">Order Summary</h2>
          <ul className="space-y-2">
            {cartItems.map((item) => (
              <li key={item.id} className="flex justify-between">
                <span>{item.name}</span>
                <span>{item.price.toFixed(2)}₮ x {item.quantity}</span>
              </li>
            ))}
          </ul>
          <p className="mt-4 font-bold">Total: {total.toFixed(2)}₮</p>
          <button
            onClick={() => alert('Proceeding to payment...')}
            className="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
          >
            Proceed to Payment
          </button>
        </div>
      </div>
    </div>
  );
};

export default MenuLayout;
