import React, { useState, useEffect } from 'react';
import ProductCard from './ProductCard';
import Cart from './Cart';

const MenuLayout = ({ products }) => {
  const [cartItems, setCartItems] = useState(() => {
    const savedCart = localStorage.getItem('cart');
    return savedCart ? JSON.parse(savedCart) : [];
  });

  useEffect(() => {
    localStorage.setItem('cart', JSON.stringify(cartItems));
  }, [cartItems]);

  const addToCart = (product) => {
    setCartItems((prevItems) => {
      const existingItem = prevItems.find(item => item.id === product.id);
      if (existingItem) {
        return prevItems.map(item =>
          item.id === product.id ? { ...item, quantity: item.quantity + 1 } : item
        );
      }
      return [...prevItems, { ...product, quantity: 1 }];
    });
  };

  const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);

  return (
    <div className="container mx-auto px-4 py-6">
      <div className="flex flex-col items-center mb-6">
        <h1 className="text-3xl font-bold text-center">Nice Fries</h1>
        <nav className="mt-4 space-x-2">
          <button className="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600">Appetizers</button>
          <button className="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600">Entrees</button>
          <button className="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600">Main Courses</button>
          <button className="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600">Desserts</button>
          <button className="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600">Drinks</button>
        </nav>
      </div>
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div className="products grid grid-cols-1 gap-4">
          {products.map((product) => (
            <ProductCard key={product.id} product={product} addToCart={addToCart} />
          ))}
        </div>
        <div className="order-summary col-span-1 md:col-span-2 bg-gray-100 p-4 rounded shadow">
          <h2 className="text-xl font-semibold mb-4">Order Summary</h2>
          <ul className="space-y-2">
            {cartItems.map((item) => (
              <li key={item.id} className="flex justify-between">
                <span>{item.name}</span>
                <span>${item.price} x {item.quantity}</span>
              </li>
            ))}
          </ul>
          <p className="mt-4 font-bold">Total: ${total.toFixed(2)}</p>
          <button onClick={() => alert('Proceeding to payment...')} className="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Proceed to Payment
          </button>
        </div>
      </div>
      <Cart cartItems={cartItems} setCartItems={setCartItems} />
    </div>
  );
};

export default MenuLayout;
