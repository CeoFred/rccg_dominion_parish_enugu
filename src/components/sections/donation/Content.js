import React, { Component, Fragment } from 'react';
import Donationform from './Donationform';
import Serviceblock from './Serviceblock';

class Content extends Component {
    render() {
        return (
            <Fragment>
                <Donationform />
                <Serviceblock />
            </Fragment>
        );
    }
}

export default Content;