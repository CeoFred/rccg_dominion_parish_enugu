import React, { Component } from 'react';
import Slider from 'react-slick';
import testimonials from "../../../data/testimonials.json";

const settings = {
    slidesToShow: 1, slidesToScroll: 1, arrows: false, dots: true, dotsClass: "slick-dots d-flex", autoplay: true
};

class Shorttestimonials extends Component {
    render() {
        return (
            <Slider {...settings} className="basic-dot-slider light-dots">
                {/* Data */}
                {testimonials.map((item, i) => (
                    <div className="slide-item" key={i}>
                        <p className="mb-0">{item.comment}</p>
                    </div>
                ))}
                {/* Data */}
            </Slider>
        );
    }
}

export default Shorttestimonials;