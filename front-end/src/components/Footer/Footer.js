import { Row, Col } from 'antd';
import './Footer.css';
const Footer = () => {
  return (
    <>
      <div className='footer'>
        <h2>Về Chúng Tôi</h2>
        <Row justify="space-around">
          <Col span={4}>
            <h3>Column 1</h3>
            <p>Some information about column 1</p>
          </Col>
          <Col span={4}>
            <h3>Column 2</h3>
            <p>Some information about column 2</p>
          </Col>
          <Col span={4}>
            <h3>Column 3</h3>
            <p>Some information about column 3</p>
          </Col>
          <Col span={4}>
            <h3>Column 3</h3>
            <p>Some information about column 3</p>
          </Col>
        </Row>
      </div>
    </>
  );
};

export default Footer;
