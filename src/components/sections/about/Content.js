import React, { Component, Fragment } from 'react';
import Abouttext from './Abouttext';
import Approch from './Approch';
import Blogs from './Blogs';
import History from './History';
import Quotecta from '../../layouts/Quotecta';

class Content extends Component {
    render() {
        return (
            <Fragment>
                <Abouttext />
                <History />
                <Approch />
                <Quotecta />
                <Blogs />
            </Fragment>
        );
    }
}

export default Content;