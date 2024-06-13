import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import ministryblock from "../../../data/ministry/ministry.json";

class Ministry extends Component {
    render() {
        return (
            <div className="section section-padding">
                <div className="container-fluid">
                    <div className="row">
                        {/* Data */}
                        {ministryblock.slice(0, 3).map((item, i) => (
                            <div className="col-lg-4" key={i}>
                                <div className="sigma_portfolio-item">
                                    <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                                    <div className="sigma_portfolio-item-content">
                                        <div className="sigma_portfolio-item-content-inner">
                                            <h5> <Link to={"/ministry-details/" + item.id}>{item.title}</Link> </h5>
                                            <p className="blockquote bg-transparent">{item.shorttext.slice(0, 70)}</p>
                                        </div>
                                        <Link to={"/ministry-details/" + item.id}><i className="fal fa-plus" /></Link>
                                    </div>
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

export default Ministry;