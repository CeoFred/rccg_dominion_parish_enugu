import React from 'react';
import CountUp from "react-countup";
import VisibilitySensor from "react-visibility-sensor";

function Successrate(props) {
    const [focus, setFocus] = React.useState(false);
    return (
        <div className="section pt-0">
            <div className="container">
                <div className="row align-items-center">
                    <div className="col-lg-4">
                        <img src={process.env.PUBLIC_URL + "/assets/img/progress-bar/1.jpg"} alt="img" />
                    </div>
                    <div className="col-lg-4 p-3 p-lg-0">
                        <div className="sigma_box sigma_box-absolute sigma_box-lg m-0 sigma_box-progress">
                            <i className="flaticon-sun" />
                            <div className="sigma_round-button mb-4">
                                <span>
                                    <CountUp start={focus ? 0 : null} end={75} duration={5} redraw={true}>
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
                                    <span className="custom-primary">%</span> </span>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 197 197" enableBackground="new 0 0 197 197" xmlSpace="preserve">
                                    <circle className="sigma_round-button-stroke" strokeLinecap="round" cx="98.5" cy="98.6" r="97.5" />
                                    <circle className="sigma_progress-round sigma_round-button-circle" style={{ strokeDashoffset: 290 + "px" }} strokeLinecap="round" cx="98.5" cy="98.6" r="97.5" />
                                </svg>
                            </div>
                            <h6>Donation Success Rate</h6>
                            <p className="m-0 blockquote bg-transparent"> Design better websites and spend less time without restricting </p>
                        </div>
                    </div>
                    <div className="col-lg-4 z-index-3">
                        <img src={process.env.PUBLIC_URL + "/assets/img/progress-bar/2.jpg"} alt="img" />
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Successrate;