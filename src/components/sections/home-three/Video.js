import React, { Component } from 'react';

class Video extends Component {
    render() {
        return (
            <div className="section section-lg bg-cover bg-norepeat bg-center" style={{ backgroundImage: "url(" + process.env.PUBLIC_URL + "/assets/img/bg1.jpg)" }}>
                <div className="section d-flex align-items-center justify-content-center">
                    <a rel={"external"} href={"https://www.youtube.com/watch?v=TKnufs85hXk"} className="sigma_video-popup popup-youtube">
                        <i className="fas fa-play" />
                    </a>
                </div>
            </div>
        );
    }
}

export default Video;