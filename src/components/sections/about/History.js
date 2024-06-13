import React, { Component } from 'react';
import history from "../../../data/history.json";

class History extends Component {
    render() {
        return (
            <div className="section light-bg">
                <div className="container">
                    <div className="sigma_timeline">
                        {/* Data */}
                        {history.map((item, i) => (
                            <div className="row g-0 justify-content-end justify-content-md-around align-items-start sigma_timeline-nodes" key={i}>
                                <div className="col-12 col-md-5 order-3 order-md-1 sigma_timeline-content">
                                    <h4>{item.title}</h4>
                                    <p>{item.text}</p>
                                </div>
                                <div className="col-2 col-sm-1 px-md-3 order-2 sigma_timeline-image text-md-center">
                                    <i className="far fa-circle" />
                                </div>
                                <div className="col-12 col-md-5 order-1 order-md-3 pb-3 sigma_timeline-date">
                                    <span>{item.year}</span><br /><span className="sigma_timeline-month">{item.date}</span>
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

export default History;