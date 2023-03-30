import React from "react";
import { Carousel, Card, Divider } from "antd";
import {jobsCarouselItems, companiesCarouselItems } from "./CarouselItem";
import "./Carousel.css";

const CarouselBox = () => {
  return (
    <>
    <div className="carousel-jobs-box">
      {jobsCarouselItems.map((item) => (
        <div key={item.id}>
          <Divider plain><h2>{item.title}</h2></Divider>
          <div className="carousel-container">
            <div className="view-more">
              <a href="/">Xem thêm</a>
            </div>
            <div className="jobs-carousel">
              <Carousel slidesToShow={4}>
                {item.children.map((child) => (
                  <Card
                    hoverable
                    key={child.id}
                    className="item-card"
                    cover={<img src={child.image} alt={child.title} />}
                  >
                    <Card.Meta
                      title={child.title}
                      description={child.salary}
                      className="item-card-meta"
                    />
                  </Card>
                ))}
              </Carousel>
            </div>
          </div>
        </div>
      ))}
    </div>
    <div className="carousel-companies-box">
    {companiesCarouselItems.map((item) => (
      <div key={item.id}>
        <Divider plain><h2>{item.title}</h2></Divider>
        <div className="carousel-container">
          <div className="view-more">
            <a href="/">Xem thêm</a>
          </div>
          <div className="companies-carousel">
            <Carousel slidesToShow={4}>
              {item.children.map((child) => (
                <Card
                  hoverable
                  key={child.id}
                  className="item-card"
                  cover={<img src={child.image} alt={child.title} />}
                >
                  <Card.Meta
                    title={child.title}
                    className="item-card-meta"
                    description={child.address}
                  />
                </Card>
              ))}
            </Carousel>
          </div>
        </div>
      </div>
    ))}
    </div>
    </>
  );
};

export default CarouselBox;
