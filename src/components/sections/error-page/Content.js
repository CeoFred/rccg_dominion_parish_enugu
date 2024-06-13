import React, { Component } from 'react';
import { Link } from 'react-router-dom';

class Content extends Component {
    render() {
        return (
            <section className="section pb-0 errorpage">
                <div className="container">
                    <div className="row align-items-center">
                        <div className="col-lg-7 text-center">
                            <img src={process.env.PUBLIC_URL + "/assets/img/banner/png/5.png"} alt="img" />
                        </div>
                        <div className="col-lg-5 text-center">
                            <div className="error-texts relative">
                                <h1>404</h1>
                                <h3>Ooops! That page doesn't exist!</h3>
                                <p>This file May Have Been Moved or Deleted. Be Sure to Check Your Spelling.</p>
                                <Link to="/" className="sigma_btn-custom">Back to Home</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

export default Content;