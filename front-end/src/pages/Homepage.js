import Layout from "../components/Layout/Layout";
import Helmet from "react-helmet";
import HomeSearchBar from "../components/SearchBar/HomeSearchBar";
import Carousel from "../components/Carousel/Carousel";
const Homepage = () => {
    return (
      <>
      <Helmet>
        <title>FinDev - Tìm việc nhanh gọn!</title>
        <meta name="description" content="Tìm việc nhanh" />
      </Helmet>
        <Layout>
            <HomeSearchBar/>
            <Carousel/>
        </Layout>
        </>
    );
};

export default Homepage;