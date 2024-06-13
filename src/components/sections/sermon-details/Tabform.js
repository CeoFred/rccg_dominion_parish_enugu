import React, { Component } from 'react';
import { Tab, Nav } from "react-bootstrap";
import { Link } from 'react-router-dom';

class Tabform extends Component {
    render() {
        return (
            <div className="section section-padding pt-0 pb-0">
                <div className="row">
                    <div className="col-lg-6">
                        <Tab.Container defaultActiveKey="tab10">
                            <Nav varient="tabs" className="nav-tabs">
                                <Nav.Item>
                                    <Nav.Link eventKey="tab10"> <i className="far fa-cross" /> Ministry </Nav.Link>
                                </Nav.Item>
                                <Nav.Item>
                                    <Nav.Link eventKey="tab11"> <i className="far fa-church" /> Church </Nav.Link>
                                </Nav.Item>
                                <Nav.Item>
                                    <Nav.Link eventKey="tab12"> <i className="far fa-user" /> Pastor </Nav.Link>
                                </Nav.Item>
                            </Nav>
                            <Tab.Content>
                                <Tab.Pane eventKey="tab10">
                                    <div className="custom-form">
                                        <form>
                                            <div className="form-group">
                                                <input type="text" placeholder="Enter Full Name" className="form-control" name="name" />
                                                <i className="far fa-user" />
                                            </div>
                                            <div className="form-group">
                                                <input type="text" placeholder="Enter Email Address" className="form-control" name="name" />
                                                <i className="far fa-envelope" />
                                            </div>
                                            <div className="form-group">
                                                <input type="text" placeholder="Enter Full Name" className="form-control" name="name" />
                                                <i className="far fa-user" />
                                            </div>
                                            <div className="form-group">
                                                <button type="submit" className="sigma_btn-custom d-block w-100" name="button">Start
                                                    Saving Today</button>
                                            </div>
                                            <div className="row">
                                                <div className="col-lg-6">
                                                    <div className="sigma_icon-block icon-block-8">
                                                        <div className="icon-wrapper">
                                                            <i className="fas fa-lock" />
                                                        </div>
                                                        <div className="sigma_icon-block-content">
                                                            <h6>Already a Member?</h6>
                                                            <Link to="#">Sign In</Link>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="col-lg-6">
                                                    <div className="sigma_icon-block icon-block-8">
                                                        <div className="icon-wrapper">
                                                            <i className="fas fa-star" />
                                                        </div>
                                                        <div className="sigma_icon-block-content">
                                                            <div className="sigma_rating">
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                            </div>
                                                            <span className="custom-primary">100k+ Reviews</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </Tab.Pane>
                                <Tab.Pane eventKey="tab11">
                                    <div className="custom-form">
                                        <form>
                                            <div className="form-group">
                                                <input type="text" placeholder="Enter Full Name" className="form-control" name="name" />
                                                <i className="far fa-user" />
                                            </div>
                                            <div className="form-group">
                                                <input type="text" placeholder="Enter Email Address" className="form-control" name="name" />
                                                <i className="far fa-envelope" />
                                            </div>
                                            <div className="form-group">
                                                <input type="text" placeholder="Enter Full Name" className="form-control" name="name" />
                                                <i className="far fa-user" />
                                            </div>
                                            <div className="form-group">
                                                <button type="submit" className="sigma_btn-custom d-block w-100" name="button">Start
                                                    Saving Today</button>
                                            </div>
                                            <div className="row">
                                                <div className="col-lg-6">
                                                    <div className="sigma_icon-block icon-block-8">
                                                        <div className="icon-wrapper">
                                                            <i className="fas fa-lock" />
                                                        </div>
                                                        <div className="sigma_icon-block-content">
                                                            <h6>Already a Member?</h6>
                                                            <Link to="#">Sign In</Link>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="col-lg-6">
                                                    <div className="sigma_icon-block icon-block-8">
                                                        <div className="icon-wrapper">
                                                            <i className="fas fa-star" />
                                                        </div>
                                                        <div className="sigma_icon-block-content">
                                                            <div className="sigma_rating">
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                            </div>
                                                            <span className="custom-primary">100k+ Reviews</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </Tab.Pane>
                                <Tab.Pane eventKey="tab12">
                                    <div className="custom-form">
                                        <form>
                                            <div className="form-group">
                                                <input type="text" placeholder="Enter Full Name" className="form-control" name="name" />
                                                <i className="far fa-user" />
                                            </div>
                                            <div className="form-group">
                                                <input type="text" placeholder="Enter Email Address" className="form-control" name="name" />
                                                <i className="far fa-envelope" />
                                            </div>
                                            <div className="form-group">
                                                <input type="text" placeholder="Enter Full Name" className="form-control" name="name" />
                                                <i className="far fa-user" />
                                            </div>
                                            <div className="form-group">
                                                <button type="submit" className="sigma_btn-custom d-block w-100" name="button">Start
                                                    Saving Today</button>
                                            </div>
                                            <div className="row">
                                                <div className="col-lg-6">
                                                    <div className="sigma_icon-block icon-block-8">
                                                        <div className="icon-wrapper">
                                                            <i className="fas fa-lock" />
                                                        </div>
                                                        <div className="sigma_icon-block-content">
                                                            <h6>Already a Member?</h6>
                                                            <Link to="#">Sign In</Link>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="col-lg-6">
                                                    <div className="sigma_icon-block icon-block-8">
                                                        <div className="icon-wrapper">
                                                            <i className="fas fa-star" />
                                                        </div>
                                                        <div className="sigma_icon-block-content">
                                                            <div className="sigma_rating">
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                                <i className="far fa-star active" />
                                                            </div>
                                                            <span className="custom-primary">100k+ Reviews</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </Tab.Pane>
                            </Tab.Content>
                        </Tab.Container>
                    </div>
                    <div className="col-lg-6">
                        <img src={process.env.PUBLIC_URL + "/assets/img/service/details/4.jpg"} alt="service" />
                    </div>
                </div>
            </div>
        );
    }
}

export default Tabform;