import React from 'react';

const ProductCard = ({ product, addToCart }) => {
  return (
    <div className="flex bg-white p-4 rounded-lg shadow-md">
      <img src={product.image} alt={product.name} className="w-24 h-24 object-cover rounded-md mr-4" />
      <div className="flex-grow">
        <h2 className="text-lg font-bold">{product.name}</h2>
        <p className="text-sm text-gray-600">{product.description}</p>
        <p className="text-gray-800 mt-2">${product.price.toFixed(2)}</p>
        <button 
          onClick={() => addToCart(product)} 
          className="bg-[#F7DC69] mt-2 px-4 py-2 rounded-md font-semibold">
          Add
        </button>
      </div>
    </div>
  );
};

export default ProductCard;
