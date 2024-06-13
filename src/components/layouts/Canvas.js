import React, { Component } from 'react';
import insta from "../../data/insta.json";
import { Link } from 'react-router-dom';

class Canvas extends Component {
    render() {
        return (
            <div className="sidebar d-block">
                <div className="sidebar-widget widget-logo">
                    <img src={process.env.PUBLIC_URL + "/assets/img/logo.png"} className="mb-30" alt="img" />
                    <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada.
                        Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.</p>
                </div>
                {/* Instagram Start */}
                <div className="sidebar-widget widget-ig">
                    <h5 className="widget-title">Instagram</h5>
                    <div className="row">
                        {/* Data */}
                        {insta.slice(0, 6).map((item, i) => (
                            <div className="col-lg-4 col-md-4 col-sm-4 col-6" key={i}>
                                <Link to="#" className="sigma_ig-item">
                                    <img src={process.env.PUBLIC_URL + "/" + item.image} alt="ig" />
                                </Link>
                            </div>
                        ))}
                        {/* Data */}
                    </div>
                </div>
                {/* Instagram End */}
                {/* Social Media Start */}
                <div className="sidebar-widget">
                    <h5 className="widget-title">Follow Us</h5>
                    <div className="sigma_post-share">
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
                </div>
                {/* Social Media End */}
            </div>
        );
    }
}

export default Canvas;