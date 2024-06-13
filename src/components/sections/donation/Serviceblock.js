import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import serviceblock from '../../../data/service/service.json';

class Serviceblock extends Component {
    render() {
        return (
            <div className="section section-padding light-bg">
                <div className="container">
                    <div className="row align-items-center">
                        <div className="col-md-5">
                            <div className="section-title text-end">
                                <p className="subtitle">WAYS WE CAN HELP</p>
                                <h4 className="title">Angels Ready To Help</h4>
                            </div>
                        </div>
                        <div className="col-md-2 d-none d-md-block"> <span className="vertical-seperator" /> </div>
                        <div className="col-md-5 d-none d-md-block">
                            <p className="fw-600 mb-0 custom-secondary">We offer a variety of customizable products and sermon for
                                individuals, families, and businesses</p>
                        </div>
                    </div>
                    <div className="row">
                        {/* Data */}
                        {serviceblock.slice(0, 2).map((item, i) => (
                            <div className="col-lg-6 col-md-6" key={i}>
                                <Link to="/sermons" className="sigma_service style-3">
                                    <div className="sigma_service-thumb">
                                        <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                                        <i className={item.icon} />
                                    </div>
                                    <div className="sigma_service-body">
                                        <h5>{item.title}</h5>
                                        <p>{item.shorttext}</p>
                                    </div>
                                </Link>
                            </div>
                        ))}
                        {/* Data */}
                    </div>
                </div>
            </div>
        );
    }
}

export default Serviceblock;