import React, { Component, Fragment } from 'react';
import Contactblock from './Contactblock';
import Contactinfo from './Contactinfo';

class Content extends Component {
    render() {
        return (
            <Fragment>
                <Contactblock />
                <Contactinfo />
            </Fragment>
        );
    }
}

export default Content;