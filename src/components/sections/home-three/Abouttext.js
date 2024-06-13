import React from 'react';
import CountUp from "react-countup";
import VisibilitySensor from "react-visibility-sensor";

function Abouttext(props) {
    const [focus, setFocus] = React.useState(false);
    return (
        <section className="section section-md light-bg">
            <div className="container">
                <div className="row align-items-center">
                    <div className="col-lg-6 mb-lg-30">
                        <div className="section-title section-title-2 text-start">
                            <p className="subtitle">About Us</p>
                            <h4 className="title">We Are A Church That Believes In Jesus</h4>
                            <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
                        </div>
                        <div className="d-flex align-items-center mt-5">
                            <div className="sigma_round-button me-4 sm">
                                <span> <CountUp start={focus ? 0 : null} end={75} duration={5} redraw={true}>
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
                                </CountUp> <span className="custom-primary">%</span> </span>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 197 197" enableBackground="new 0 0 197 197" xmlSpace="preserve">
                                    <circle className="sigma_round-button-stroke" strokeLinecap="round" cx="98.5" cy="98.6" r="97.5" />
                                    <circle style={{ strokeDashoffset: 290 + "px" }} className="sigma_progress-round sigma_round-button-circle" strokeLinecap="round" cx="98.5" cy="98.6" r="97.5" />
                                </svg>
                            </div>
                            <div>
                                <h5 className="mb-2">Ethnic Community</h5>
                                <p className="mb-0">Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus magna justo, lacinia eget consectetur sed</p>
                            </div>
                        </div>
                        <div className="d-flex align-items-center mt-5">
                            <div className="sigma_round-button me-4 sm">
                                <span> <CountUp start={focus ? 0 : null} end={50} duration={5} redraw={true}>
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
                                </CountUp> <span className="custom-secondary">%</span> </span>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 197 197" enableBackground="new 0 0 197 197" xmlSpace="preserve">
                                    <circle className="sigma_round-button-stroke" strokeLinecap="round" cx="98.5" cy="98.6" r="97.5" />
                                    <circle style={{ strokeDashoffset: 400 + "px" }} className="sigma_progress-round sigma_round-button-circle secondary" strokeLinecap="round" cx="98.5" cy="98.6" r="97.5" />
                                </svg>
                            </div>
                            <div>
                                <h5 className="mb-2">Active Members</h5>
                                <p className="mb-0">Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus magna justo, lacinia eget consectetur sed</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-lg-6 d-none d-lg-block">
                        <div className="me-lg-30 img-group-2">
                            <img src={process.env.PUBLIC_URL + "/assets/img/about-group2/1.jpg"} alt="about" />
                            <img src={process.env.PUBLIC_URL + "/assets/img/about-group2/2.jpg"} alt="about" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}

export default Abouttext;