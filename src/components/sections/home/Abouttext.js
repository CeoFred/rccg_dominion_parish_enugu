import React from 'react';
import CountUp from "react-countup";
import { Link } from 'react-router-dom';
import VisibilitySensor from "react-visibility-sensor";

function Abouttext(props) {
    const [focus, setFocus] = React.useState(false);
    return (
        <section className="section pt-0">
            <div className="container">
                <div className="row">
                    <div className="col-lg-5 d-none d-lg-block">
                        <div className="sigma_counter bg-cover primary-overlay bg-norepeat bg-center" style={{ backgroundImage: 'url(assets/img/counter.jpg)' }}>
                            <h4>
                                <CountUp start={focus ? 0 : null} end={25} duration={5} redraw={true}>
                                    {({ countUpRef }) => (
                                        <VisibilitySensor
                                            onChange={isVisible => {
                                                if (isVisible) {
                                                    setFocus(true);
                                                }
                                            }}
                                        >
                                            <b ref={countUpRef} className="counter" />
                                        </VisibilitySensor>
                                    )}
                                </CountUp>
                                <span>+</span>
                            </h4>
                            <p>Join Our Church</p>
                        </div>
                    </div>
                    <div className="col-lg-7">
                        <div className="me-lg-30">
                            <div className="section-title mb-0 text-start">
                                <p className="subtitle">We Have 25+ Years of Experience</p>
                                <h4 className="title">We Are A Church That Believes In God.</h4>
                            </div>
                            <p className="blockquote bg-transparent"> We are a church that belives in Jesus christ and the followers and We are a church that belives in Jesus christ </p>
                            <div className="row">
                                <div className="col-lg-6">
                                    <div className="sigma_icon-block icon-block-3">
                                        <div className="icon-wrapper">
                                            <i className="flaticon-church-2" />
                                        </div>
                                        <div className="sigma_icon-block-content">
                                            <h5> Helping Hand </h5>
                                            <p>Vestibulum ac diam sit amet quam vehicula elementum sed.</p>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-lg-6">
                                    <div className="sigma_icon-block icon-block-3">
                                        <div className="icon-wrapper">
                                            <i className="flaticon-charity" />
                                        </div>
                                        <div className="sigma_icon-block-content">
                                            <h5> Open Hearts </h5>
                                            <p>Vestibulum ac diam sit amet quam vehicula elementum sed.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <Link to="/about" className="sigma_btn-custom light">Learn More <i className="far fa-arrow-right" /> </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}

export default Abouttext;