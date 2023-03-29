import { Col, Row } from "antd"
import Search from "antd/es/transfer/search";
import './HomeSearchBar.css'
const HomeSearchBar = () => {
    const handleSearch = (value) => {
        console.log(value)
    };
    return(
        <div className="search-bar-container">
            <Row>
                <Col flex={2}></Col>
                <Col flex={1}>
                    <div className="search-bar">
                        <Search
                            placeholder="Tìm kiếm công việc/ công ty..."
                            onSearch={handleSearch}
                            onPressEnter={(e) => handleSearch(e.target.value)}
                        />
                    </div>
                </Col>
                <Col flex={2}></Col>
            </Row>
        </div>
    )
}
export default HomeSearchBar;