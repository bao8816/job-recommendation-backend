import React from 'react';
import {Row, Col, Button } from 'react-bootstrap';

const LogoRow = () => {
    return (
        <Row className='align-items-center'>
            <Col xs={2}>
                <img src="https://via.placeholder.com/50x50?text=Logo" alt="Logo" />
            </Col>
            <Col xs={10}>
                <div className='text-end'>
                    <Button variant="outline-primary">Login</Button>
                    <Button variant="primary" className="ms-2">Sign up</Button>
                </div>
            </Col>
        </Row>
    );
}
export default LogoRow;