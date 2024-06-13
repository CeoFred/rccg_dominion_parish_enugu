import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import donationblock from "../../../data/donation/donation.json";

class Donation extends Component {
    render() {
        return (
            <div className="section section-padding pt-0">
                <div className="container">
                    <div className="section-title text-center">
                        <p className="subtitle">Donate To Help</p>
                        <h4 className="title">Make a Donation to Help Community</h4>
                    </div>
                    <div className="row">
                        {/* Data */}
                        {donationblock.slice(0, 3).map((item, i) => (
                            <div className="col-lg-4 col-md-6" key={i}>
                                <div className="sigma_service style-2">
                                    <div className="sigma_service-thumb">
                                        <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                                    </div>
                                    <div className="sigma_service-body">
                                        <h5>
                                            <Link to="/donation">{item.title}</Link>
                                        </h5>
                                        <p>{item.shorttext}</p>
                                        <div className="sigma_service-progress">
                                            <div className="progress-content">
                                                <p>Raised: ${new Intl.NumberFormat().format(item.raised)}</p>
                                                <p>Goal: ${new Intl.NumberFormat().format(item.goal)}</p>
                                            </div>
                                            <div className="sigma_progress">
                                                <div className="progress">
                                                    <div className="progress-bar" style={{ width: item.raised * 100 / item.goal + "%" }}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <Link to="/donation" className="sigma_btn-custom">
                                            Donate
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        ))}
                        {/* Data */}
                    </div>
                </div>
            </div>
        );
    }
}

export default Donation;