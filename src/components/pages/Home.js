import React, { Component, Fragment } from 'react';
import MetaTags from "react-meta-tags";
import Header from '../layouts/Header';
import Footer from '../layouts/Footer';
import Content from '../sections/home/Content';

const pagelocation = "Homepage";

class Home extends Component {
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
                <footer className="sigma_footer footer-2 sigma_footer-dark">
                    <Footer />
                </footer>
            </Fragment>
        );
    }
}

export default Home;