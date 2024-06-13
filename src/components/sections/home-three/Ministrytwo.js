import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import Slider from 'react-slick';
import ministryblock from "../../../data/ministry/ministry.json";
import { getCategories } from "../../../helper/ministryHelper";

const settings = {
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    autoplay: false,
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 1
            }
        }
    ]
};
class Ministrytwo extends Component {
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
            <div className="section section-padding bg-cover portfolio-section" style={{ backgroundImage: "url(" + process.env.PUBLIC_URL + "/assets/img/textures/abstract.png)" }}>
                <div className="container">
                    <div className="section-title section-title-2 flex-title">
                        <div>
                            <p className="subtitle light">Portfolio</p>
                            <h4 className="text-white title mb-lg-0">Our Ministries</h4>
                        </div>
                        <div className="sigma_arrows">
                            <i className="far fa-chevron-left slick-arrow slider-prev" onClick={this.previous} />
                            <i className="far fa-chevron-right slick-arrow slider-next" onClick={this.next} />
                        </div>
                    </div>
                    <Slider ref={c => (this.slider = c)} {...settings} className="portfolio-slider">
                        {/* Data */}
                        {ministryblock.map((item, i) => (
                            <div className="sigma_portfolio-item style-3" key={i}>
                                <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                                <div className="sigma_portfolio-item-content">
                                    <div className="sigma_portfolio-item-content-inner">
                                        {getCategories(item.category).slice(0, 1).map((cat, i) => (
                                            <Link to={"/ministry/cat/" + cat.id} key={i}>{cat.title}</Link>
                                        ))}
                                        <h5> <Link to={"/ministry-details/" + item.id}>{item.title}</Link> </h5>
                                    </div>
                                    <Link to={"/ministry-details/" + item.id}><i className="far fa-arrow-right" /></Link>
                                </div>
                            </div>
                        ))}
                        {/* Data */}
                    </Slider>
                </div>
            </div>
        );
    }
}

export default Ministrytwo;