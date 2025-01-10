import React from 'react';
import logo from '../Components/Images/logoo.png'; 

export default function ApplicationLogo(props) {
    return (
        <img
            {...props}
            src={logo}
            alt="Foodbazalt Logo"
            className="w-32 h-32 rounded-full bg-[#170801] flex items-center justify-center"
            height={32}
            width={32}
        />
    );
}
