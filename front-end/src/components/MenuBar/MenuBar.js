import { Menu, Row, Col } from 'antd';
import { DownOutlined } from '@ant-design/icons';
import menuItems from './MenuData';
import './MenuBar.css'
const HorizontalMenuBar = () => {
  const renderSubMenu = (subMenu) => {
    return (
      <Menu.SubMenu key={subMenu.key} title={subMenu.title}>
        {subMenu.children.map((child) => {
          if (child.children) {
            return renderSubMenu(child);
          }
          return (
            <Menu.Item key={child.key}>
              {child.title}
            </Menu.Item>
          );
        })}
      </Menu.SubMenu>
    );
  };

  return (
    <div className="horizontal-menu-bar">
    <Row justify="space-between">
      <Col span={2}></Col>
      <Col span={20} style={{ flex: 1}}>
        <Menu mode="horizontal">
          {menuItems.map((menuItem) => {
            if (menuItem.children) {
              return renderSubMenu(menuItem);
            }
            return (
              <Menu.Item key={menuItem.key}>
                {!menuItem.key.includes('.') ? menuItem.title : (
                  <>
                    {menuItem.title}
                    <DownOutlined />
                  </>
                )}
              </Menu.Item>
            );
          })}
        </Menu>
      </Col>
      <Col span={2}></Col>
    </Row>
    </div>
  );
};

export default HorizontalMenuBar;
