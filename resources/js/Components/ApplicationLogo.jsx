import React from 'react';
import logo from '../Components/Images/logoo2.png'; 

export default function ApplicationLogo(props) {
    return (
        <img
            {...props}
            src={logo}
            alt="Foodbazalt Logo"
            className="w-48 h-full bg-white flex items-center justify-center"
        />
    );
}
