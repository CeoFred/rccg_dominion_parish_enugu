import React, { Component, Fragment } from 'react';
import Faqblock from './Faqblock';
import Quotecta from '../../layouts/Quotecta';

class Content extends Component {
    render() {
        return (
            <Fragment>
                <Faqblock />
                <Quotecta />
            </Fragment>
        );
    }
}

export default Content;