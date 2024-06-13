import React, { Component, Fragment } from 'react';
import Block from './Block';
import Blogs from './Blogs';

class Content extends Component {
    render() {
        return (
            <Fragment>
                <Block />
                <Blogs />
            </Fragment>
        );
    }
}

export default Content;