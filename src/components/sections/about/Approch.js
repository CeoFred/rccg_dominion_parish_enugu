import React, { Component } from 'react';
import approch from "../../../data/approch.json";
import { Tab, Nav } from "react-bootstrap";

class Approch extends Component {
    render() {
        return (
            <section className="section">
                <div className="container">
                    <div className="row align-items-center">
                        <div className="col-lg-6">
                            <div className="me-lg-30">
                                <div className="section-title mb-0 text-start">
                                    <p className="subtitle">Our Approach</p>
                                    <h4 className="title">Advancing Regime's Domestic and Foreign</h4>
                                </div>
                                <p className="blockquote bg-transparent"> We are a church that belives in Jesus christ and the followers
                                    and We are a church that belives in Jesus christ </p>
                                <Tab.Container defaultActiveKey={"tab10"}>
                                    <Nav varient="tabs" className="nav-tabs">
                                        {approch.map((item, i) => (
                                            <Nav.Item key={i}>
                                                <Nav.Link eventKey={"tab" + 1 + i}> <i className={item.icon} /> {item.title} </Nav.Link>
                                            </Nav.Item>
                                        ))}
                                    </Nav>
                                    <Tab.Content>
                                        {approch.map((item, i) => (
                                            <Tab.Pane key={i} eventKey={"tab" + 1 + i}>
                                                <div dangerouslySetInnerHTML={{ __html: item.htmltext }} />
                                            </Tab.Pane>
                                        ))}
                                    </Tab.Content>
                                </Tab.Container>
                            </div>
                        </div>
                        <div className="col-lg-6">
                            <img src={process.env.PUBLIC_URL + "/assets/img/about.jpg"} alt="about" />
                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

export default Approch;