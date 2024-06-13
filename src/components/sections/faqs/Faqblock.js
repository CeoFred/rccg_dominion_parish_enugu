import React, { Component } from 'react';
import faqs from "../../../data/faqs.json";
import { Accordion, Card, Button } from 'react-bootstrap';

class Faqblock extends Component {
    render() {
        return (
            <div className="section">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-6">
                            <Accordion defaultActiveKey={1} className="with-gap">
                                {faqs.slice(0, 4).map((item, i) => (
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
                        <div className="col-lg-6">
                            <Accordion defaultActiveKey={1} className="with-gap">
                                {faqs.slice(4, 8).map((item, i) => (
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
        );
    }
}

export default Faqblock;