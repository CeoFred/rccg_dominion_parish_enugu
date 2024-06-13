import React, { Component } from 'react';
import features from "../../../data/features.json";

class Features extends Component {
    render() {
        return (
            <div className="sigma_box pb-0 m-0">
                <div className="row">
                    {/* Data */}
                    {features.slice(0, 3).map((item, i) => (
                        <div className="col-md-4" key={i}>
                            <div className="sigma_icon-block icon-block-3">
                                <div className="icon-wrapper">
                                    <i className={item.icon} />
                                </div>
                                <div className="sigma_icon-block-content">
                                    <h5> {item.title} </h5>
                                    <p>{item.text}</p>
                                </div>
                            </div>
                        </div>
                    ))}
                    {/* Data */}
                </div>
            </div>
        );
    }
}

export default Features;