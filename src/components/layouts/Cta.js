import React, { Component } from 'react';

class Cta extends Component {
    render() {
        return (
            <div className="section section-padding">
                <div className="container">
                    <div className="section-title text-center">
                        <p className="subtitle">WAYS WE CAN HELP</p>
                        <h4 className="title">Angels Ready To Help</h4>
                    </div>
                    <div className="row position-relative">
                        <div className="col-md-6">
                            <div className="sigma_cta secondary-bg">
                                <img className="d-none d-lg-block" src={process.env.PUBLIC_URL + "/assets/img/cta/1.png"} alt="cta" />
                                <div className="sigma_cta-content">
                                    <span className="fw-600 custom-primary">Need Help, Call Our HOTLINE!</span>
                                    <h4 className="text-white">+1 212-683-9756</h4>
                                </div>
                            </div>
                        </div>
                        <span className="sigma_cta-sperator d-none d-lg-flex">or</span>
                        <div className="col-md-6">
                            <div className="sigma_cta primary-bg">
                                <div className="sigma_cta-content">
                                    <form>
                                        <label className="mb-0 text-white">Our Church Newsletter</label>
                                        <div className="sigma_search-adv-input">
                                            <input type="text" className="form-control" placeholder="Enter email address" name="search" />
                                            <button type="submit" name="button"><i className="fa fa-search" /></button>
                                        </div>
                                    </form>
                                </div>
                                <img className="d-none d-lg-block" src={process.env.PUBLIC_URL + "/assets/img/cta/2.png"} alt="cta" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Cta;