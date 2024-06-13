import React, { Component, Fragment } from 'react';
import { Link } from 'react-router-dom';
import { getNextEvent, getDateInitials } from "../../helper/eventHelper";

class Eventsidebar extends Component {
    render() {
        return (
            <Fragment>
                {/* Categories Start */}
                <div className="sidebar-widget widget-upcoming-events">
                    <h5 className="widget-title"> Upcoming Events </h5>
                    <ul>
                        {/* Data */}
                        {getNextEvent().map((item, i) => (
                            <li key={i}>
                                <div className="date" dangerouslySetInnerHTML={{ __html: getDateInitials(item.eventdate) }}>
                                </div>
                                <div className="event-name">
                                    <h6>{item.title}</h6>
                                    <p>{item.eventtime}</p>
                                </div>
                            </li>
                        ))}
                        {/* Data */}
                    </ul>
                    <div className="text-center">
                        <Link to="/events" className="sigma_btn-custom mt-4">See All</Link>
                    </div>
                </div>
                {/* Categories End */}
                {/* Social Media Start */}
                <div className="sidebar-widget">
                    <h5 className="widget-title">Never Miss Out</h5>
                    <ul className="sigma_sm square light">
                        <li>
                            <Link to="#">
                                <i className="fab fa-facebook-f" />
                            </Link>
                        </li>
                        <li>
                            <Link to="#">
                                <i className="fab fa-linkedin-in" />
                            </Link>
                        </li>
                        <li>
                            <Link to="#">
                                <i className="fab fa-twitter" />
                            </Link>
                        </li>
                        <li>
                            <Link to="#">
                                <i className="fab fa-youtube" />
                            </Link>
                        </li>
                    </ul>
                </div>
                {/* Social Media End */}
            </Fragment>
        );
    }
}

export default Eventsidebar;