import React from "react";
import logoImage from "../Components/Images/logoo2.png";
const Header = ({ restaurants = {} }) => {
    return (
        <div className="border border-gray-300 rounded header bg-gray-100 px-5 gap-2">
            <div className="flex-grow relative h-[80px]">
                <div className="flex gap-2.5 items-center justify-between h-full px-4">
                    {/* Logo */}
                    <a href={route("order")}>
                        <img
                            src={logoImage}
                            alt="Logo"
                            className="header__logo max-h-[80px]"
                        />
                    </a>
                </div>
            </div>
        </div>
    );
};

export default Header;
