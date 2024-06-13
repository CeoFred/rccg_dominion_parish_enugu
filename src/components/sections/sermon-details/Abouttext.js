import React, { Component } from 'react';

class Abouttext extends Component {
    render() {
        return (
            <div className="section">
                <div className="row">
                    <div className="col-lg-6">
                        <div className="sigma_img-box">
                            <div className="row">
                                <div className="col-lg-6">
                                    <img src={process.env.PUBLIC_URL + "/assets/img/service/details/2.jpg"} alt="service" />
                                </div>
                                <div className="col-lg-6 mt-5">
                                    <img src={process.env.PUBLIC_URL + "/assets/img/service/details/3.jpg"} alt="service" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="col-lg-6">
                        <div className="me-lg-30">
                            <div className="section-title text-start">
                                <p className="subtitle">Features</p>
                                <h4 className="title">Check it Out Our Privacy Policy</h4>
                            </div>
                            <ul className="sigma_list list-2">
                                <li>Peace of Mind</li>
                                <li>Set For Pastor</li>
                                <li>100% Satisfaction</li>
                                <li>Trusted Company</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Abouttext;