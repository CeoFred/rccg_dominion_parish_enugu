import React, { Component } from 'react';
import { Link } from 'react-router-dom';

class Breadcrumbs extends Component {
    render() {
        return (
            <div className="sigma_subheader dark-overlay dark-overlay-2" style={{ backgroundImage: "url(" + process.env.PUBLIC_URL + "/assets/img/subheader.jpg)" }}>
                <div className="container">
                    <div className="sigma_subheader-inner">
                        <div className="sigma_subheader-text">
                            <h1>{this.props.breadcrumb.pagename}</h1>
                            <p className="blockquote light"> We are a church that belives in Jesus christ and the followers and
                                We are a church that belives in Jesus christ </p>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><Link to="/" className="btn-link">Home</Link></li>
                                <li className="breadcrumb-item active" aria-current="page">{this.props.breadcrumb.pagename}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        );
    }
}

export default Breadcrumbs;