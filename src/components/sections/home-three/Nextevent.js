import React, { Component, Fragment } from 'react';
import { Link } from 'react-router-dom';
import { getDateInitials, getNextEvent } from "../../../helper/eventHelper";

class Nextevent extends Component {
    render() {
        return (
            <Fragment>
                {getNextEvent().slice(0, 1).map((item, i) => (
                    <div className="sigma_sermon-box" key={i}>
                        <div className="sigma_box">
                            <span className="subtitle">Next Event</span>
                            <h4 className="title mb-0">
                                <Link to={"/event-details/" + item.id}>{item.title}</Link>
                            </h4>
                            <div className="sigma_sermon-info">
                                <div className="sigma_sermon-date" dangerouslySetInnerHTML={{ __html: getDateInitials(item.eventdate) }} />
                                <ul className="sigma_sermon-descr m-0">
                                    <li>
                                        <i className="far fa-clock" />
                                        {item.eventtime}
                                    </li>
                                    <li>
                                        <i className="far fa-map-marker-alt" />
                                        {item.location}
                                    </li>
                                </ul>
                            </div>
                            <div className="section-button d-flex align-items-center">
                                <Link to={"/event-details/" + item.id} className="sigma_btn-custom secondary">Join Now <i className="far fa-arrow-right" /> </Link>
                            </div>
                        </div>
                    </div>
                ))}
            </Fragment>
        );
    }
}

export default Nextevent;