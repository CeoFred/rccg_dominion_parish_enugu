import React, { Component, Fragment } from 'react';
import MetaTags from "react-meta-tags";
import Header from '../layouts/Headerthree';
import Footer from '../layouts/Footer';
import Content from '../sections/home-three/Content';

const pagelocation = "Homepage";

class Homethree extends Component {
    render() {
        return (
            <Fragment>
                <MetaTags>
                    <title>RCCG Dominion Parish -  Enugu Province 2. {pagelocation}</title>
                    <meta
                        name="description"
                        content="#"
                    />
                </MetaTags>
                <Header />
                <Content />
                <footer className="sigma_footer footer-2 bg-cover bg-center bg-transparent light-overlay" style={{ backgroundImage: "url(" + process.env.PUBLIC_URL + "/assets/img/footer.jpg)" }}>
                    <Footer />
                </footer>
            </Fragment>
        );
    }
}

export default Homethree;