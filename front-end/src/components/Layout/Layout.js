import LogoRow from "../LogoRow/LogoRow";
import HorizontalMenuBar from "../MenuBar/MenuBar";
import Footer from "../Footer/Footer";
const Layout = ({ children }) => {
    return (
        <div className="layout">
            <LogoRow/>
            <HorizontalMenuBar/>
            <div className="content">{children}</div>
            <Footer/>
        </div>
    );
};
export default Layout;