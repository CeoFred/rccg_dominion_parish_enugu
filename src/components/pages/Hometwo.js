import React, { Component, Fragment } from 'react';
import MetaTags from "react-meta-tags";
import Header from '../layouts/Headertwo';
import Footer from '../layouts/Footer';
import Content from '../sections/home-two/Content';

const pagelocation = "Homepage";

class Hometwo extends Component {
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
                <Content />
                <footer className="sigma_footer footer-2">
                    <Footer />
                </footer>
            </Fragment>
        );
    }
}

export default Hometwo;