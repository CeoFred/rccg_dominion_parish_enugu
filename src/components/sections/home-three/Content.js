import React, { Component, Fragment } from 'react';
import Abouttext from './Abouttext';
import Banner from './Banner';
import Blogs from './Blogs';
import Faqs from './Faqs';
import Features from './Features';
import Locationmap from './Locationmap';
import Ministry from './Ministry';
import Ministrytwo from './Ministrytwo';
import Nextevent from './Nextevent';
import Nextsermon from './Nextsermon';
import Pagecta from './Pagecta';
import Services from './Services';
import Video from './Video';

class Content extends Component {
    render() {
        return (
            <Fragment>
                <Banner />
                {/* Sermons Start */}
                <div className="section section-padding secondary-bg">
                    <div className="container">
                        <div className="row sigma_sermon-box-wrapper">
                            <div className="col-lg-6">
                                <Nextevent />
                            </div>
                            <div className="col-lg-6">
                                <Nextsermon />
                            </div>
                        </div>
                    </div>
                </div>
                {/* Sermons End */}
                <Services />
                <Abouttext />
                <Pagecta />
                <Locationmap />
                <Ministrytwo />
                <Faqs />
                <Video />
                <Ministry />
                <Blogs />
                <div className="section mb-negative p-0">
                    <Features />
                </div>
            </Fragment>
        );
    }
}

export default Content;