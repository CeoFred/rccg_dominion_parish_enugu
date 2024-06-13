import React, { Component, Fragment } from 'react';
import Abouttext from './Abouttext';
import Banner from './Banner';
import Blockbox from './Blockbox';
import Blogs from './Blogs';
import Broadcast from './Broadcast';
import Donation from './Donation';
import Ministry from './Ministry';
import Pagecta from './Pagecta';
import Testimonials from './Testimonials';
import Volunteers from './Volunteers';

class Content extends Component {
    render() {
        return (
            <Fragment>
                <Banner />
                <Blockbox />
                <Abouttext />
                <Pagecta />
                <Donation />
                <Broadcast />
                <Ministry />
                <Volunteers />
                <Testimonials />
                <Blogs />
            </Fragment>
        );
    }
}

export default Content;