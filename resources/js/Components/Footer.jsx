import React from "react";
import logoImage from "@/Components/Images/logoo.png";

const Footer = () => {
    return (
        <footer className="bg-orange-400 rounded-lg shadow m-4">
            <div className="max-w-screen-xl mx-auto p-6 md:py-10">
                {/* Logo and Links Section */}
                <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    {/* Logo */}
                    <a
                        href="#"
                        className="flex items-center mb-6 sm:mb-0 space-x-3 rtl:space-x-reverse"
                    >
                        <img
                            src={logoImage}
                            className="h-14 w-auto"
                            alt="Company Logo"
                        />
                        <span className="text-3xl font-bold text-white">
                            FoodBazalt
                        </span>
                    </a>

                    {/* Navigation Links */}
                    <ul className="flex flex-wrap items-center justify-center text-base font-medium text-white space-x-8 rtl:space-x-reverse">
                        <li>
                            <a href="#" className="hover:underline">
                                Танилцуулга
                            </a>
                        </li>
                        <li>
                            <a href="#" className="hover:underline">
                                Меню
                            </a>
                        </li>
                        <li>
                            <a href="#" className="hover:underline">
                                Холбоо барих
                            </a>
                        </li>
                    </ul>
                </div>

                {/* Separator */}
                <hr className="my-6 border-t border-white opacity-40 sm:mx-auto" />

                {/* Copyright Section */}
                <div className="text-center">
                    <span className="text-base text-white block">
                        © 2024{" "}
                        <a
                            href="#"
                            className="hover:underline font-bold text-white"
                        >
                            FoodBazalt™
                        </a>
                        . MSmart Academy Дипломын ажилд зориулан хөгжүүлэв.
                    </span>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
