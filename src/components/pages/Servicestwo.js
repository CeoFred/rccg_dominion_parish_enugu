import React, { Component, Fragment } from 'react';
import MetaTags from "react-meta-tags";
import Header from '../layouts/Headerthree';
import Breadcrumbs from '../layouts/Breadcrumbs';
import Footer from '../layouts/Footer';
import Content from '../sections/services-two/Content';

const pagelocation = "Services";

class Servicestwo extends Component {
    render() {
        return (
            <Fragment>
                <MetaTags>
                    <title>RCCG Dominion Parish - Enugu Province 2. | {pagelocation}</title>
                    <meta
                        name="description"
                        content="#"
                    />
                </MetaTags>
                <Header />
                <Breadcrumbs breadcrumb={{ pagename: pagelocation }} />
                <Content />
                <footer className="sigma_footer footer-2 sigma_footer-dark">
                    <Footer />
                </footer>
            </Fragment>
        );
    }
}

export default Servicestwo;