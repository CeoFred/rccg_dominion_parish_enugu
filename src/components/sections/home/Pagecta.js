import React, { Component } from 'react';

class Pagecta extends Component {
    render() {
        return (
            <div className="section pt-0">
                <div className="container">
                    <div className="row position-relative">
                        <div className="col-lg-7 col-md-6">
                            <div className="sigma_cta lg secondary-bg">
                                <img className="d-none d-lg-block" src={process.env.PUBLIC_URL + "/assets/img/cta/3.png"} alt="cta" />
                                <div className="sigma_cta-content">
                                    <span className="fw-600 custom-primary">Need Help, Call Our HOTLINE!</span>
                                    <h4 className="text-white">+1 212-683-9756</h4>
                                </div>
                            </div>
                        </div>
                        <div className="col-lg-5 col-md-6 position-relative">
                            <div className="sigma_cta sm primary-bg">
                                <span className="sigma_cta-sperator d-none d-lg-flex">or</span>
                                <div className="sigma_cta-content">
                                    <form>
                                        <label className="mb-0 text-white">Our Church Newsletter</label>
                                        <div className="sigma_search-adv-input">
                                            <input type="text" className="form-control" placeholder="Enter email address" name="search" />
                                            <button type="submit" name="button"><i className="far fa-envelope" /></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Pagecta;