import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import Slider from 'react-slick';
import banner from "../../../data/bannertwo.json";

const settings = {
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    autoplay: false,
    responsive: [
        {
            breakpoint: 991,
            settings: {
                arrows: false
            }
        }
    ]
}

class Banner extends Component {
    render() {
        return (
            <div className="sigma_banner banner-3">
                <Slider {...settings} className="sigma_banner-slider">
                    {/* Banner Item Start */}
                    {banner.map((item, i) => (
                        <div key={i}>
                            <div className="light-bg sigma_banner-slider-inner bg-cover bg-center bg-norepeat" style={{ backgroundImage: "url(" + process.env.PUBLIC_URL + "/" + item.image + ")" }}>
                                <div className="sigma_banner-text">
                                    <div className="container">
                                        <div className="row align-items-center">
                                            <div className="col-lg-6">
                                                <h1 className="title">{item.title}</h1>
                                                <p className="blockquote mb-0 bg-transparent">{item.text}</p>
                                                <div className="section-button d-flex align-items-center">
                                                    <Link to="/contact" className="sigma_btn-custom">Join Today <i className="far fa-arrow-right" /> </Link>
                                                    <Link to="/services" className="ms-3 sigma_btn-custom white">View Services <i className="far fa-arrow-right" /> </Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}
                    {/* Banner Item End */}
                </Slider>
            </div>
        );
    }
}

export default Banner;