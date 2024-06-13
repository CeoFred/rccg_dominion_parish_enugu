import React, { Component } from 'react';

class Preloader extends Component {
    constructor(props) {
        super(props);
        this.state = {
            // Load
            loading: true
        };
    }
    // Window Load
    PreloaderLoad = e => {
        this.setState({ loading: this.state.loading });
    };
    render() {
        const preloaderload = this.state.loading ? ' hidden' : '';
        return (
            <div className={"sigma_preloader" + preloaderload}>
                <img src={process.env.PUBLIC_URL + "/assets/img/christian.svg"} alt="preloader" />
            </div>
        );
    }
}

export default Preloader;