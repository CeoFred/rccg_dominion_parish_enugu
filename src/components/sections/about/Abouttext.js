import React, { Component } from 'react';

class Abouttext extends Component {
    render() {
        return (
            <section className="section">
                <div className="container">
                    <div className="row align-items-center">
                        <div className="col-lg-6 d-none d-lg-block">
                            <div className="sigma_img-box">
                                <div className="row">
                                    <div className="col-lg-6">
                                        <img src={process.env.PUBLIC_URL + "/assets/img/service/details/5.jpg"} alt="service" />
                                        <img className="ms-0" src={process.env.PUBLIC_URL + "/assets/img/service/details/6.jpg"} alt="service" />
                                    </div>
                                    <div className="col-lg-6 mt-0 mt-lg-5">
                                        <img src={process.env.PUBLIC_URL + "/assets/img/service/details/7.jpg"} alt="service" />
                                        <img className="ms-0" src={process.env.PUBLIC_URL + "/assets/img/service/details/8.jpg"} alt="service" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="col-lg-6">
                            <div className="me-lg-30">
                                <div className="section-title mb-0 text-start">
                                    <p className="subtitle">We have 25+ years of experience</p>
                                    <h4 className="title">We Provide Exceptional Solution For Clients</h4>
                                </div>
                                <p className="blockquote bg-transparent"> We are a church that belives in Jesus christ and the followers and We are a church that belives in Jesus christ </p>
                                <div className="sigma_icon-block icon-block-3">
                                    <div className="icon-wrapper">
                                        <img src={process.env.PUBLIC_URL + "/assets/img/textures/icons/1.png"} alt="" />
                                    </div>
                                    <div className="sigma_icon-block-content">
                                        <h5> Our Church </h5>
                                        <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla porttitor accumsan tincidunt.</p>
                                    </div>
                                </div>
                                <div className="sigma_icon-block icon-block-3">
                                    <div className="icon-wrapper">
                                        <img src={process.env.PUBLIC_URL + "/assets/img/textures/icons/2.png"} alt="" />
                                    </div>
                                    <div className="sigma_icon-block-content">
                                        <h5> Ministries </h5>
                                        <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla porttitor accumsan tincidunt.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

export default Abouttext;