const Order = ({ categories, products }) => {
    // Энэ хэсэгт categories болон products массивын утгуудыг шалгана
    if (!products || !categories) {
        return <div>Loading...</div>; // Хэрэв мэдээлэл байхгүй бол "Loading..." гэж харагдуулна
    }

    const [cartItems, setCartItems] = useState(JSON.parse(localStorage.getItem('cart')) || []);
    const [activeCategory, setActiveCategory] = useState('All');
    const [tableId, setTableId] = useState(localStorage.getItem('tableId') || '');

    const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);

    useEffect(() => {
        localStorage.setItem('tableId', tableId);
    }, [tableId]);

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

    const filteredProducts = activeCategory === 'All'
        ? products
        : products.filter((product) => product.category === activeCategory);

    return (
        <div className="p-4 md:p-6 bg-slate-950 min-h-screen">
            {/* Header */}
            <div className="bg-white p-4 shadow-md flex justify-between items-center rounded-md">
                <div className="flex items-center space-x-2">
                    <div className="w-8 h-8 flex items-center justify-center">
                        <img
                            src={logoImage}
                            alt="Logo"
                            className="object-contain w-full h-full"
                        />
                    </div>
                    <h1 className="text-xl font-bold text-gray-800">FoodBazalt</h1>
                </div>
                <button className="bg-gray-200 px-4 py-2 rounded-full text-gray-800 text-sm">
                    English
                </button>
            </div>

            {/* Search Bar */}
            <div className="flex items-center bg-gray-800 rounded-full px-4 py-2 mt-4 shadow-md">
                <i className="fas fa-search text-gray-400"></i>
                <input
                    type="text"
                    placeholder="Search your favourites..."
                    className="bg-transparent text-white placeholder-gray-500 ml-4 flex-grow focus:outline-none"
                />
                <button className="ml-4">
                    <i className="fas fa-sliders-h text-gray-400"></i>
                </button>
            </div>

            {/* Input for Table ID */}
            <div className="mb-6 mt-4">
                <label htmlFor="tableId" className="block text-sm font-medium text-gray-700">
                    Enter Table ID
                </label>
                <input
                    id="tableId"
                    value={tableId}
                    onChange={(e) => setTableId(e.target.value)}
                    hidden
                />
            </div>

            {/* Category Filter */}
            <Category
                categories={categories}
                activeCategory={activeCategory}
                setActiveCategory={setActiveCategory}
            />

            {/* Product List */}
            <div className="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 md:gap-6">
                {filteredProducts.map((product) => (
                    <Product
                        key={product.id}
                        product={product}
                        handleAddToCart={handleAddToCart}
                    />
                ))}
            </div>

            {/* Cart Component */}
            <Cart cartItems={cartItems} setCartItems={setCartItems} />
        </div>
    );
};
