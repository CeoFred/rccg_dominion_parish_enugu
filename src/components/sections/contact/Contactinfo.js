import React, { Component } from 'react';
import contactinfo from "../../../data/contactinfo.json";

class Contactinfo extends Component {
    render() {
        return (
            <div className="section section-padding pt-0">
                <div className="container">
                    <div className="row">
                        {/* Data */}
                        {contactinfo.map((item, i) => (
                            <div className="col-lg-4" key={i}>
                                <div className="sigma_icon-block text-center light icon-block-7">
                                    <i className={item.icon} />
                                    <div className="sigma_icon-block-content">
                                        <span>{item.subtitle} <i className="far fa-arrow-right" /> </span>
                                        <h5> {item.title} </h5>
                                        {/* Data */}
                                        {item.text.map((text, i) => (
                                            <p key={i}>{text}</p>
                                        ))}
                                        {/* Data */}
                                    </div>
                                    <div className="icon-wrapper">
                                        <i className={item.icon} />
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

export default Contactinfo;