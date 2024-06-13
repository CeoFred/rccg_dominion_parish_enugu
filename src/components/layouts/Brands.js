import React, { Component } from 'react';
import clients from "../../data/clients.json";

class Brands extends Component {
    render() {
        return (
            <div className="section section-padding primary-bg pattern-map">
                <div className="container-fluid">
                    <div className="row">
                        {/* Data */}
                        {clients.slice(0, 5).map((item, i) => (
                            <div className="col" key={i}>
                                <div className="sigma_client">
                                    <img src={process.env.PUBLIC_URL + "/" + item.image} alt="client" />
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

export default Brands;