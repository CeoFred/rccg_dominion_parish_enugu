import React, { Component, Fragment } from 'react';
import Cta from '../../layouts/Cta';
import Brands from '../../layouts/Brands';
import Donationblock from './Donationblock';

class Content extends Component {
    render() {
        return (
            <Fragment>
                <Donationblock />
                <Brands />
                <Cta />
            </Fragment>
        );
    }
}

export default Content;