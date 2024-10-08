import React from 'react';
import logoImage from '../admin/assets/img/logo.png'; // Adjust the path as necessary

const Logo = () => {
    return (
        <div>
            <img src={logoImage} alt="Logo" className="w-full h-full object-cover"  /> {/* Add classes as needed */}
        </div>
    );
};

export default Logo;
