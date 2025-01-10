import React from "react";

const Footer = () => {
  return (
    <footer id="footer" className="footer bg-gray-900 text-white py-10 px-5">
      <div className="container mx-auto">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {/* Address Section */}
          <div className="flex items-start space-x-4">
            <i className="bi bi-geo-alt text-xl text-orange-500"></i>
            <div>
              <h4 className="text-lg font-semibold">Хаяг</h4>
              <p>Улаанбаатар, Чингэлтэй дүүрэг</p>
              <p>Бага тойруу, 108 тоот</p>
            </div>
          </div>

          {/* Contact Section */}
          <div className="flex items-start space-x-4">
            <i className="bi bi-telephone text-xl text-orange-500"></i>
            <div>
              <h4 className="text-lg font-semibold">Холбоо барих</h4>
              <p>
                <strong>Утас:</strong> <span>+976 9911 2233</span>
              </p>
              <p>
                <strong>И-мэйл:</strong> <span>info@example.mn</span>
              </p>
            </div>
          </div>

          {/* Opening Hours Section */}
          <div className="flex items-start space-x-4">
            <i className="bi bi-clock text-xl text-orange-500"></i>
            <div>
              <h4 className="text-lg font-semibold">Ажлын цаг</h4>
              <p>
                <strong>Даваа-Бямба:</strong> <span>11:00 - 23:00</span>
              </p>
              <p>
                <strong>Ням гарагт:</strong> <span>Амарна</span>
              </p>
            </div>
          </div>

          {/* Follow Us Section */}
          <div>
            <h4 className="text-lg font-semibold">Биднийг дагах</h4>
            <div className="flex space-x-4 mt-2">
              <a
                href="#"
                className="text-gray-400 hover:text-white transition"
              >
                <i className="bi bi-twitter"></i>
              </a>
              <a
                href="#"
                className="text-gray-400 hover:text-white transition"
              >
                <i className="bi bi-facebook"></i>
              </a>
              <a
                href="#"
                className="text-gray-400 hover:text-white transition"
              >
                <i className="bi bi-instagram"></i>
              </a>
              <a
                href="#"
                className="text-gray-400 hover:text-white transition"
              >
                <i className="bi bi-linkedin"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div className="container mx-auto text-center mt-8">
        <p>FoodBazalt 2024</p>
      </div>
    </footer>
  );
};

export default Footer;
