import React, { Component } from 'react';
import Slider from 'react-slick';
import testimonials from "../../../data/testimonials.json";
import { getAuthor, Rating } from "../../../helper/helper";

const settings = {
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    autoplay: true,
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 1
            }
        }
    ]
};

class Testimonials extends Component {
    constructor(props) {
        super(props);
        this.next = this.next.bind(this);
        this.previous = this.previous.bind(this);
    }
    next() {
        this.slider.slickNext();
    }
    previous() {
        this.slider.slickPrev();
    }
    render() {
        return (
            <section className="section pt-0">
                <div className="container testimonial-section bg-contain bg-norepeat bg-center" style={{ backgroundImage: "url(" + process.env.PUBLIC_URL + "/assets/img/textures/map-2.png)" }}>
                    <div className="section-title text-center">
                        <p className="subtitle">Testimonials</p>
                        <h4 className="title">What Our Congregation Say</h4>
                    </div>
                    <div className="sigma_testimonial style-2">
                        <Slider ref={c => (this.slider = c)} {...settings} className="sigma_testimonial-slider">
                            {/* Data */}
                            {testimonials.map((item, i) => (
                                <div key={i}>
                                    <div className="sigma_testimonial-inner">
                                        {getAuthor(item.author).map((author, i) => (
                                            <div className="sigma_testimonial-thumb" key={i}>
                                                <img src={process.env.PUBLIC_URL + "/" + author.image} alt={author.name} />
                                            </div>
                                        ))}
                                        <div>
                                            <div className="sigma_testimonial-body">
                                                <div className="sigma_rating-wrapper">
                                                    <div className="sigma_rating">
                                                        {Rating(item.rating)}
                                                    </div>
                                                </div>
                                                <p>{item.comment}</p>
                                            </div>
                                            {getAuthor(item.author).map((author, i) => (
                                                <div className="sigma_testimonial-footer" key={i}>
                                                    <div className="sigma_testimonial-author">
                                                        <cite>{author.name}</cite>
                                                        <span>{author.post}</span>
                                                    </div>
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                </div>
                            ))}
                            {/* Data */}
                        </Slider>
                    </div>
                    <div className="text-center mt-4">
                        <div className="sigma_arrows style-2">
                            <i className="far fa-chevron-left slick-arrow slider-prev" onClick={this.previous} />
                            <i className="far fa-chevron-right slick-arrow slider-next" onClick={this.next} />
                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

export default Testimonials;