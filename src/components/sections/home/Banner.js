import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import Slider from 'react-slick';
import banner from "../../../data/banner.json";

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
            <div className="sigma_banner banner-1 bg-cover light-overlay bg-center bg-norepeat" style={{ backgroundImage: "url(" + process.env.PUBLIC_URL + "/assets/img/banner/9.jpg)" }}>
                <Slider {...settings} className="sigma_banner-slider">
                    {/* Banner Item Start */}
                    {banner.map((item, i) => (
                        <div key={i} className="sigma_banner-slider-inner">
                            <div className="sigma_banner-text">
                                <div className="container position-relative">
                                    <div className="row align-items-center">
                                        <div className={"col-lg-6 " + item.position}>
                                            <div className="sigma_box primary-bg banner-cta">
                                                <h1 className="text-white title">{item.title}</h1>
                                                <p className="blockquote light light-border mb-0">{item.text}</p>
                                                <div className="section-button d-flex align-items-center">
                                                    <Link to="/contact" className="sigma_btn-custom secondary">Join Today <i className="far fa-arrow-right" /> </Link>
                                                    <Link to="/donation" className="ms-3 sigma_btn-custom light text-white">Donate Us <i className="far fa-arrow-right" /> </Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <img className={"d-none d-lg-block " + item.imageposition} src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
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