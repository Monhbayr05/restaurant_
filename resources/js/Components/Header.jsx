import React from "react";
import logoImage from "../Components/logoo.png";
const Header = ({ restaurants = {} }) => {
    return (
        <div className="border border-gray-300 rounded header bg-gray-100 px-5 gap-2">
            <div className="flex-grow relative h-[80px]">
                <div className="flex gap-2.5 items-center justify-between h-full px-4">
                    {/* Logo */}
                    <img
                        src={logoImage}
                        alt="Logo"
                        className="header__logo max-h-[80px]"
                    />
                    {/* Restaurant Name */}
                    <div className="header__restaurant-name">
                        <h2 className="text-sm text-orange-500 font-bold">
                            {restaurants.name || "Restaurant Name"}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Header;
