import React, { Component } from 'react';
import Slider from 'react-slick';
import testimonials from "../../../data/testimonials.json";
import { getAuthor } from "../../../helper/helper";

const settings = {
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    dotsClass:"slick-dots d-flex",
    autoplay: true
};

class Testimonials extends Component {
    render() {
        return (
            <section className="section sigma_testimonial-sec style-4">
                <div className="container testimonial-section style-4">
                    <div className="row">
                        <div className="col-lg-5">
                            <div className="section-title text-start">
                                <p className="subtitle">Testimonials</p>
                                <h4 className="title">What Our Members Say</h4>
                                <p>We are a church that belives in Jesus christ and the followers and We are a church that belives in Jesus christ. This is where you should start Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod</p>
                            </div>
                        </div>
                        <div className="col-lg-7">
                            <div className="sigma_testimonial style-4">
                                <div className="sigma_testimonial-body">
                                    <div className="sigma_testimonial-image d-none d-lg-block">
                                        <div className="row justify-content-center align-items-center g-0">
                                            <div className="col-md-3">
                                                <img src={process.env.PUBLIC_URL + "/assets/img/testimonials/c-img01.png"} alt="img" />
                                            </div>
                                            <div className="col-md-5 ms-3">
                                                <img src={process.env.PUBLIC_URL + "/assets/img/testimonials/c-img04.png"} alt="img" />
                                            </div>
                                            <div className="col-md-3 ms-3">
                                                <img src={process.env.PUBLIC_URL + "/assets/img/testimonials/c-img03.png"} alt="img" />
                                            </div>
                                        </div>
                                    </div>
                                    <i className="flaticon-right-quote icon" />
                                    <Slider {...settings} className="sigma_testimonial-slider-1">
                                        {/* Data */}
                                        {testimonials.map((item, i) => (
                                            <div className="sigma_testimonial-slider-item" key={i}>
                                                <p>{item.comment}</p>
                                                {getAuthor(item.author).map((author, i) => (
                                                    <div className="sigma_testimonial-author" key={i}>
                                                        <cite>{author.name}</cite>
                                                    </div>
                                                ))}
                                            </div>
                                        ))}
                                        {/* Data */}
                                    </Slider>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

export default Testimonials;