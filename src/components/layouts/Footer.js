import React, { Component, Fragment } from 'react';
import { Link } from 'react-router-dom';
import links from "../../data/footerlinks.json";
import { getRecentPost } from "../../helper/blogHelper";

class Footer extends Component {
    render() {
        return (
            <Fragment>
                {/* Middle Footer */}
                <div className="sigma_footer-middle">
                    <div className="container">
                        <div className="row">
                            <div className="col-xl-4 col-lg-4 col-md-4 col-sm-12 footer-widget">
                                <h5 className="widget-title">About Us</h5>
                                <p className="mb-4">The Redeemed Christian Church of God (RCCG) is a global community of believers committed to holiness, evangelism, and transforming lives through Christ's love.</p>
                                <div className="d-flex align-items-center justify-content-md-start justify-content-center">
                                    <i className="far fa-phone custom-primary me-3" />
                                    <span>+234 807 604 4682</span>
                                </div>
                                <div className="d-flex align-items-center justify-content-md-start justify-content-center mt-2">
                                    <i className="far fa-envelope custom-primary me-3" />
                                    <span>dominion.parish.enugu@gmail.com</span>
                                </div>
                                <div className="d-flex align-items-center justify-content-md-start justify-content-center mt-2">
                                    <i className="far fa-map-marker custom-primary me-3" />
                                    <span>13, Emyson Avenue, Phase 6, Trans Ekulu, Enugu, Enugu, Nigeria.</span>
                                </div>
                            </div>
                            {/* Data */}
                            {links.map((data, i) => (
                                <div className="col-xl-2 col-lg-2 col-md-4 col-sm-12 footer-widget" key={i}>
                                    <h5 className="widget-title">{data.title}</h5>
                                    <ul>
                                        {/* Data */}
                                        {data.items.map((item, i) => (
                                            <li key={i}>
                                                <Link to={item.link}>{item.title}</Link>
                                            </li>
                                        ))}
                                        {/* Data */}
                                    </ul>
                                </div>
                            ))}
                            {/* Data */}
                            <div className="col-xl-4 col-lg-4 col-md-3 col-sm-12 d-none d-lg-block footer-widget widget-recent-posts">
                                <h5 className="widget-title">Recent Posts</h5>
                                {/* Data */}
                                {getRecentPost().map((item, i) => (
                                    <article className="sigma_recent-post" key={i}>
                                        <Link to={"/blog-details/" + item.id}>
                                            <img src={process.env.PUBLIC_URL + "/" + item.image[0]} alt={item.title} />
                                        </Link>
                                        <div className="sigma_recent-post-body">
                                            <Link to={"/blog-details/" + item.id}> <i className="far fa-calendar" /> {item.postdate}</Link>
                                            <h6> <Link to={"/blog-details/" + item.id}>{item.title}</Link> </h6>
                                        </div>
                                    </article>
                                ))}
                                {/* Data */}
                            </div>
                        </div>
                    </div>
                </div>
                {/* Footer Bottom */}
                <div className="sigma_footer-bottom">
                    <div className="container-fluid">
                        <div className="sigma_footer-copyright">
                            <p> Copyright © RCCG Dominion Parish - <Link to="#" className="text-black">2024</Link> </p>
                        </div>
                        <div className="sigma_footer-logo">
                            {/* <img src={process.env.PUBLIC_URL + "/assets/img/logo.png"} alt="logo" /> */}
                        </div>
                        <ul className="sigma_sm square">
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
            </Fragment>
        );
    }
}

export default Footer;