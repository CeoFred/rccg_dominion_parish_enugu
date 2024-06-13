import React, { Component } from 'react';
import { Link } from 'react-router-dom';

class Abouttext extends Component {
    render() {
        return (
            <section className="section">
                <div className="container">
                    <div className="row align-items-center">
                        <div className="col-lg-6 mb-lg-30">
                            <div className="img-group">
                                <div className="img-group-inner">
                                    <img src={process.env.PUBLIC_URL + "/assets/img/about-group1/1.jpg"} alt="about" />
                                    <span />
                                    <span />
                                </div>
                                <img src={process.env.PUBLIC_URL + "/assets/img/about-group1/2.jpg"} alt="about" />
                                <img src={process.env.PUBLIC_URL + "/assets/img/about-group1/3.jpg"} alt="about" />
                            </div>
                        </div>
                        <div className="col-lg-6">
                            <div className="me-lg-30">
                                <div className="section-title mb-0 text-start">
                                    <p className="subtitle">we have 24+ years of experience</p>
                                    <h4 className="title">We Are A Church That Believes In GOD.</h4>
                                </div>
                                <ul className="sigma_list list-2 mb-0">
                                    <li>Peace of Mind</li>
                                    <li>Set For Pastor</li>
                                    <li>100% Satisfaction</li>
                                    <li>Trusted Company</li>
                                </ul>
                                <p className="blockquote bg-transparent"> We are a church that belives in Jesus christ and the followers
                                    and We are a church that belives in Jesus christ </p>
                                <Link to="/about" className="sigma_btn-custom light">Learn More <i className="far fa-arrow-right" />
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

export default Abouttext;