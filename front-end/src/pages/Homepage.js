import React from 'react';
import { Helmet } from 'react-helmet';
import LogoRow from '../components/navBar/navBar';
const Homepage = () => {
  return (
    <>
      <Helmet>
        <title>Tìm việc nhanh</title>
        <meta name="description" content="Tìm việc nhanh" />
      </Helmet>
        <LogoRow/>
    </>
  );
};

export default Homepage;