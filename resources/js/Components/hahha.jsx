import axios from "axios";
import React, { useState } from "react";

function PaymentButton({ phoneNumber, totalPrice }) {
  const [loading, setLoading] = useState(false);

  const handleCreateInvoice = async () => {
    setLoading(true);

    // IMPORTANT: In production, do not expose Bearer tokens in frontend code.
    const YOUR_BEARER_TOKEN = "p0dOx59YXXAEbwSXwYvlfBoRYCI1JYUAiwteVABd8100c42a";
    const YOUR_PROJECT_ID = 117;
    // From props
    const amount = totalPrice; 
    const description = phoneNumber; 

    try {
      const response = await axios.post(
        `https://byl.mn/api/v1/projects/${YOUR_PROJECT_ID}/invoices`,
        {
          amount,
          description,
          auto_advance: true,
        },
        {
          headers: {
            Authorization: `Bearer ${YOUR_BEARER_TOKEN}`,
            Accept: "application/json",
            "Content-Type": "application/json",
          },
        }
      );

      const invoiceUrl = response.data?.data?.url;
      if (invoiceUrl) {
        window.location.href = invoiceUrl; 
      } else {
        alert("Error: No invoice URL returned.");
      }
    } catch (error) {
      console.error("Error creating invoice:", error);
      alert("Error creating invoice. Check console for details.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <button onClick={handleCreateInvoice} disabled={loading}>
      {loading ? "Processing..." : "Pay with BYL"}
    </button>
  );
}

export default PaymentButton;



{isModalOpen && (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div className="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <h2 className="text-xl font-bold mb-4">Төлбөр төлөх</h2>
            <form onSubmit={handleFormSubmit} className="space-y-4">
                <input
                    type="tel"
                    placeholder="Утасны дугаар"
                    value={phoneNumber}
                    onChange={(e) => setPhoneNumber(e.target.value)}
                    className="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none"
                    required
                />
                <textarea
                    name="description"
                    rows="4"
                    className="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none"
                    placeholder="Хэрэв таньд бидэнд мэдэгдэх зүйл байвал заавал бичнэ үү. (Харшилтай, Давс хэрэглэдэггүй гэх мэт)"
                    value={description}
                    onChange={(e) => setNotes(e.target.value)}
                ></textarea>
                <button
                    type="submit"
                    className="w-full bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600"
                >
                    Төлөх: {totalPrice.toFixed(2)}₮
                </button>
            </form>
            <button
                onClick={() => setModalOpen(false)}
                className="mt-4 w-full bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400"
            >
                Болих
            </button>
        </div>
    </div>
)}



    // Handle form submission
    const handleFormSubmit = async (e) => {
        e.preventDefault();

        const csrfToken = document
            .querySelector('meta[name="csrf-token1"]')
            .getAttribute("content");

        const checkoutData = {
            totalAmount: totalPrice,
            cartItems: cartItems.map(({ id, name, price, quantity }) => ({
                id,
                name,
                price,
                quantity,
            })),
            description,
            tableId,
            phoneNumber,
        };

        try {
             console.log(totalPrice, phoneNumber);
            const bylResponse = await axios.post(
                "https://byl.mn/api/v1/projects/117/invoices",
                {
                    amount: totalPrice,
                    description: phoneNumber,
                },
                {
                    headers: {
                        Authorization: `Bearer ${bearerToken}`,
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        "Accept": "application/json",
                    },
                }
            );

            console.log("Byl API Response:", bylResponse.data);
            alert("Захиалга амжилттай хийгдлээ!");
            setCartItems([]);
            localStorage.removeItem("cart");
        } catch (error) {
            if (error.response) {
                console.error("Server-side error:", error.response.data);
                alert(
                    `Алдаа гарлаа: ${
                        error.response.data.message || "Unknown error"
                    }`
                );
            } else if (error.request) {
                console.error("Network error:", error.request);
                alert("Сүлжээний алдаа гарлаа.");
            } else {
                console.error("Error:", error.message);
                alert("Алдаа гарлаа.");
            }
        }
    };


        // Sync description and tableId to localStorage
        useEffect(() => {
            localStorage.setItem("description", description);
        }, [description]);
    
        useEffect(() => {
            localStorage.setItem("phoneNumber", phoneNumber);
        }, [phoneNumber]);




        <div className="min-h-screen bg-gray-50">
        {/* Header */}
        <header className="bg-ik-header-bg-color text-ik-header-bg-high-contrast-color">
          <Header />
        </header>
  
        {/* Main Container */}
        <div className="container mx-auto px-4 py-10">
          <h2 className="text-2xl font-bold text-gray-700 mb-6 text-center">
            Төлбөр төлөх
          </h2>
  
          <div className="grid md:grid-cols-2 gap-8">
            {/* Cart Items Section */}
            <div className="bg-white rounded-lg shadow p-6">
              <h3 className="text-lg font-semibold mb-4 text-gray-700">
                Таны захиалга
              </h3>
  
              {cartItems.length > 0 ? (
                <>
                  {cartItems.map((item) => (
                    <div
                      key={item.id}
                      className="flex items-start mb-4 border-b border-gray-200 pb-4"
                    >
                      <div>
                        <p className="text-xl font-medium text-orange-500">
                          {item.name}
                        </p>
                        <p className="text-gray-600 text-sm">
                          {item.price.toFixed(2)}₮ x {item.quantity}
                        </p>
                        <p className="text-gray-500 text-xs mt-1">
                          Нийт:{" "}
                          <span className="font-semibold">
                            {(item.price * item.quantity).toFixed(2)}₮
                          </span>
                        </p>
                      </div>
                    </div>
                  ))}
  
                  {/* Total */}
                  <div className="border-t border-gray-200 pt-4 mt-4">
                    <div className="flex justify-between items-center">
                      <span className="font-bold text-lg text-gray-700">
                        Нийт
                      </span>
                      <span className="font-bold text-lg text-gray-800">
                        {totalPrice.toFixed(2)}₮
                      </span>
                    </div>
                  </div>
                </>
              ) : (
                <p className="text-gray-500">Таны сагс хоосон байна.</p>
              )}
            </div>
  
            {/* Checkout Form Section */}
            <div className="bg-white rounded-lg shadow p-6">
              <h3 className="text-lg font-semibold mb-4 text-gray-700">
                Захиалгын мэдээлэл {table_id && ` - ${table_id}-р ширээ`}
              </h3>
              <form onSubmit={handleFormSubmit} className="space-y-5">
                {/* Phone Number */}
                <div>
                  <label
                    htmlFor="phoneNumber"
                    className="block font-medium text-gray-700 mb-1"
                  >
                    Утасны дугаар:
                  </label>
                  <input
                    id="phoneNumber"
                    type="tel"
                    value={phoneNumber}
                    placeholder="9999-9999"
                    onChange={(e) => setPhoneNumber(e.target.value)}
                    className="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-orange-500 focus:outline-none"
                    required
                  />
                </div>
  
                {/* Description */}
                <div>
                  <label
                    htmlFor="description"
                    className="block font-medium text-gray-700 mb-1"
                  >
                    Нэмэлт тайлбар:
                  </label>
                  <textarea
                    id="description"
                    rows="4"
                    value={description}
                    className="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-orange-500 focus:outline-none"
                    placeholder="Хэрэв таньд мэдэгдэх зүйл байвал бичнэ үү..."
                    onChange={(e) => setDescription(e.target.value)}
                  ></textarea>
                </div>
  
                {/* Submit Button */}
                <button
                  type="submit"
                  className="w-full bg-orange-500 text-white py-2 px-4 rounded hover:bg-orange-600 transition-colors"
                >
                  Төлөх: {totalPrice.toFixed(2)}₮
                </button>
              </form>
  
              <Link
                href={route("order")}
                className="block text-center mt-4 bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400 transition-colors"
              >
                Болих
              </Link>
            </div>
          </div>
        </div>
      </div>