import { useState } from 'react';
import { Button, Dropdown, Menu, Row, Col } from 'antd';
import { UserOutlined, SettingOutlined, LogoutOutlined } from '@ant-design/icons';
import './LogoRow.css';

const LogoRow = ({ loggedIn }) => {
  const [menuVisible, setMenuVisible] = useState(false);

  const handleMenuClick = () => {
    setMenuVisible(!menuVisible);
  };

  const menu = (
    <Menu>
      <Menu.Item key="1" icon={<UserOutlined />}>
        Tài khoản
      </Menu.Item>
      <Menu.Item key="2" icon={<SettingOutlined />}>
        Cài đặt
      </Menu.Item>
      <Menu.Item key="3" icon={<LogoutOutlined />}>
        Đăng xuất
      </Menu.Item>
    </Menu>
  );

  return (
    <div className="logo-row-container">
      <Row align="middle" justify="space-between">
        <Col span={6} offset={1}>
          <div className="logo">
            <img src="https://via.placeholder.com/80x80?text=FinDev" alt="Logo" />
            <span>FinDev</span>
          </div>
        </Col>
        <Col span={3} className="login-btn" offset={-2}>
          {loggedIn ? (
            <Dropdown
              visible={menuVisible}
              onVisibleChange={handleMenuClick}
              overlay={menu}
              trigger={['click']}
            >
              <Button icon={<UserOutlined />} size="large">
                Username
              </Button>
            </Dropdown>
          ) : (
            <Button type="primary" size="large" className="login-button" style={{ boxShadow: '0 2px 8px rgba(0, 0, 0, 0.15)', backgroundColor:'white'}}>
              <a href="/login" style={{color: 'black', fontWeight:'bold'}}>Đăng nhập</a>
            </Button>
          )}
        </Col>
      </Row>
    </div>
  );
};

export default LogoRow;
