import React, { Component, Fragment } from 'react';
import Abouttext from './Abouttext';
import Banner from './Banner';
import Blogs from './Blogs';
import Ministry from './Ministry';
import Pagecta from './Pagecta';
import Services from './Services';
import Shorttestimonials from './Shorttestimonials';
import Successrate from './Successrate';
import Testimonials from './Testimonials';
import Quotecta from '../../layouts/Quotecta';
import Volunteers from './Volunteers';

class Content extends Component {
    render() {
        return (
            <Fragment>
                <Banner />
                <Abouttext />
                <Services />
                <Pagecta />
                <Successrate />
                {/* volunteers Start */}
                <section className="section section-padding light-bg">
                    <div className="container">
                        <div className="row align-items-center">
                            <div className="col-lg-6 mb-lg-30">
                                <div className="section-title mb-0 text-start">
                                    <p className="subtitle">volunteers</p>
                                    <h4 className="title">Our Volunteers Achievments</h4>
                                </div>
                                <p className="blockquote bg-transparent"> We are a church that belives in Jesus christ and the followers and
                                    We are a church that belives in Jesus christ </p>
                                <Shorttestimonials />
                            </div>
                            <div className="col-lg-6">
                                <div className="me-lg-30">
                                    <Volunteers />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/* volunteers End */}
                <Ministry />
                <Testimonials />
                <Quotecta />
                <Blogs />
            </Fragment>
        );
    }
}

export default Content;