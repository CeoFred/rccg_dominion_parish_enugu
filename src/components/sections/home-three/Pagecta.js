import React, { Component } from 'react';
import { Link } from 'react-router-dom';

class Pagecta extends Component {
    render() {
        return (
            <div className="section mt-negative-md p-0 d-none d-lg-block">
                <div className="container">
                    <div className="p-5 bg-cover d-block d-md-flex align-items-center justify-content-between" style={{ backgroundImage: "url(" + process.env.PUBLIC_URL + "/assets/img/textures/abstract2.png)" }}>
                        <div>
                            <h5 className="text-white mb-2">Still You Need Our Support</h5>
                            <p className="text-white mb-0"> Don't wait make a smart &amp; Logical quote here. It's pretty easy. </p>
                        </div>
                        <Link to="/contact" className="mt-3 mt-md-0 sigma_btn-custom text-white light">Get a Quote</Link>
                    </div>
                </div>
            </div>
        );
    }
}

export default Pagecta;