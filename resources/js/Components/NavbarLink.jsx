import React from 'react';
import PropTypes from 'prop-types';

const NavbarLink = ({ label, route }) => {
  return (
    <a href={route} className="text-white hover:underline">
      {label}
    </a>
  );
};

NavbarLink.propTypes = {
  label: PropTypes.string.isRequired,
  route: PropTypes.string.isRequired,
};

export default NavbarLink;
