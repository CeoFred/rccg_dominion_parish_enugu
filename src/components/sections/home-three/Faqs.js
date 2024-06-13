import React, { Component } from 'react';
import faqs from "../../../data/faqs.json";
import { Accordion, Card, Button } from 'react-bootstrap';

class Faqs extends Component {
    render() {
        return (
            <section className="section">
                <div className="container">
                    <div className="row align-items-center">
                        <div className="col-lg-6 d-none d-lg-block">
                            <img src={process.env.PUBLIC_URL + "/assets/img/about3.jpg"} className="w-100" alt="about" />
                        </div>
                        <div className="col-lg-6">
                            <div className="me-lg-30">
                                <div className="section-title section-title-2 text-start">
                                    <p className="subtitle">FAQ</p>
                                    <h4 className="title">Get Every Answer From Over Here</h4>
                                    <p> Design better websites and spend less time without restricting creative freedom </p>
                                </div>
                                <Accordion defaultActiveKey={1} className="with-gap">
                                    {faqs.slice(0, 3).map((item, i) => (
                                        <Card key={i}>
                                            <Accordion.Collapse eventKey={1 + i} className="collapseparent">
                                                <Card.Body>
                                                    {item.text}
                                                </Card.Body>
                                            </Accordion.Collapse>
                                            <Card.Header>
                                                <Accordion.Toggle as={Button} variant="link" eventKey={1 + i}>
                                                    {item.title}
                                                </Accordion.Toggle>
                                            </Card.Header>
                                        </Card>
                                    ))}
                                </Accordion>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

export default Faqs;