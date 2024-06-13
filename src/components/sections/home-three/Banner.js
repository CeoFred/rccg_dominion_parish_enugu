import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import Slider from 'react-slick';
import banner from "../../../data/bannerthree.json";

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
            <div className="sigma_banner banner-2">
                <Slider {...settings} className="sigma_banner-slider">
                    {/* Banner Item Start */}
                    {banner.map((item, i) => (
                        <div key={i}>
                            <div className="light-bg sigma_banner-slider-inner bg-cover bg-center dark-overlay dark-overlay-2 bg-norepeat" style={{ backgroundImage: "url(" + process.env.PUBLIC_URL + "/" + item.image + ")" }}>
                                <div className="sigma_banner-text">
                                    <div className="container">
                                        <div className="row justify-content-center">
                                            <div className="col-lg-6 text-center">
                                                <span className="highlight-text">{item.subtitle}</span>
                                                <h1 className="text-white title">{item.title}</h1>
                                                <p className="mb-0">{item.text}</p>
                                                <Link to="/about" className="sigma_btn-custom section-button">Explore Our Church <i className="far fa-arrow-right" /> </Link>
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