import React from "react";
import { Carousel, Card } from "antd";
import carouselItems from "../Carousel/CarouselItem";
import "./Carousel.css";
const CarouselBox = () => {
  return (
    <div className="carousel-title">
        <h2>🔥 Việc làm HOT 🔥</h2>
        <div style={{ margin: "20px" }}>
        <Carousel slidesToShow={4}>
            {carouselItems.map((item) => (
            <Card key={item.id}>
                <img src={item.image} alt={item.title} />
                <h3>{item.title}</h3>
                <p>{item.description}</p>
            </Card>
            ))}
        </Carousel>
        </div>
    </div>
  );
};

export default CarouselBox;
