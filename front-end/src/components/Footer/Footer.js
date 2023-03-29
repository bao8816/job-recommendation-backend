import { Row, Col } from 'antd';

const Footer = () => {
  return (
    <Row justify="space-between" style={{position:'fixed', bottom: 0, width:'100%', backgroundColor: '#f5f5f5', padding: '24px'}}>
      <Col span={8}>
        <h3>Column 1</h3>
        <p>Some information about column 1</p>
      </Col>
      <Col span={8}>
        <h3>Column 2</h3>
        <p>Some information about column 2</p>
      </Col>
      <Col span={8}>
        <h3>Column 3</h3>
        <p>Some information about column 3</p>
      </Col>
    </Row>
  );
};

export default Footer;
