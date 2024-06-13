import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import serviceblock from "../../../data/service/service.json";

class Services extends Component {
    render() {
        return (
            <div className="section section-padding pattern-squares dark-bg-2">
                <div className="container">
                    <div className="section-title text-start">
                        <p className="subtitle">service</p>
                        <h4 className="title text-white">How We Can Help</h4>
                    </div>
                    <div className="row">
                        {/* Data */}
                        {serviceblock.slice(0, 3).map((item, i) => (
                            <div key={i} className={item.id === 2 ? 'col-lg-4 col-md-6 mt-negative-sm' : 'col-lg-4 col-md-6' && item.id === 3 ? 'col-lg-4 col-md-6 mt-negative-sm' : 'col-lg-4 col-md-6'}>
                                <Link to="/services" className={item.id === 2 ? 'sigma_service style-1 secondary-bg' : 'sigma_service style-1 primary-bg' && item.id === 3 ? 'sigma_service style-1 bg-white' : 'sigma_service style-1 primary-bg'}>
                                    <div className="sigma_service-thumb">
                                        <i className={item.id === 1 ? 'text-white '+item.icon : item.icon} />
                                    </div>
                                    <div className="sigma_service-body">
                                        <h5 className={item.id === 3 ? '' : 'text-white'}>{item.title}</h5>
                                        <p className={item.id === 3 ? '' : 'text-white'}>{item.shorttext} </p>
                                    </div>
                                    <span className={item.id === 3 ? 'btn-link' : 'btn-link text-white'}>Learn More <i className={item.id === 3 ? 'far fa-arrow-right' : 'far fa-arrow-right text-white'} /> </span>
                                </Link>
                            </div>
                        ))}
                        {/* Data */}
                    </div>
                    <div className="text-end">
                        <Link to="/services" className="btn-link text-white"> Get Started Now <i className="custom-primary far fa-arrow-right" /> </Link>
                    </div>
                </div>
            </div>
        );
    }
}

export default Services;