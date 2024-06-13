import React, { Component } from 'react';
import serviceblock from "../../../data/service/service.json";

class Services extends Component {
    render() {
        return (
            <div className="section section-padding">
                <div className="container">
                    <div className="section-title section-title-2 text-center">
                        <p className="subtitle">Features</p>
                        <h4 className="title">How We Can Help</h4>
                    </div>
                    <div className="row">
                        {/* Data */}
                        {serviceblock.slice(0, 4).map((item, i) => (
                            <div className="col-md-6" key={i}>
                                <div className="sigma_icon-block icon-block-2">
                                    <div className="icon-wrapper">
                                        <i className={item.icon} />
                                    </div>
                                    <div className="sigma_icon-block-content">
                                        <h5>{item.title}</h5>
                                        <p>{item.shorttext}</p>
                                        <i className="far fa-arrow-right" />
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

export default Services;