import React, { Component } from 'react';
import broadcast from "../../../data/broadcast.json";

class Block extends Component {
    render() {
        return (
            <div className="section section-padding">
                <div className="container">
                    <div className="section-title text-center">
                        <p className="subtitle">Watch Video</p>
                        <h4 className="title">Our Live Broadcast</h4>
                    </div>
                    <div className="row sigma_broadcast-video">
                        {/* Data */}
                        {broadcast.slice(0, 1).map((item, i) => (
                            <div className="col-12 mb-5" key={i}>
                                <div className="row g-0">
                                    <div className="col-lg-6">
                                        <div className="sigma_video-popup-wrap">
                                            <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                                            <a rel={"external"} href={item.videourl} className="sigma_video-popup popup-youtube">
                                                <i className="fas fa-play" />
                                            </a>
                                        </div>
                                    </div>
                                    <div className="col-lg-6">
                                        <div className="sigma_box m-0 h-100 d-flex align-items-center">
                                            <div>
                                                <p className="custom-primary mb-0 fw-600 fs-16">{item.broadcastdate}</p>
                                                <h4 className="title">{item.title}</h4>
                                                <p className="m-0">{item.text}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                        {/* Data */}
                        {broadcast.slice(1, 5).map((item, i) => (
                            <div className="col-lg-3 col-sm-6 mb-30" key={i}>
                                <div className="sigma_video-popup-wrap">
                                    <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                                    <a rel={"external"} href={item.videourl} className="sigma_video-popup popup-sm popup-youtube">
                                        <i className="fas fa-play" />
                                    </a>
                                </div>
                                <h6 className="mb-0 mt-3">{item.title}</h6>
                            </div>
                        ))}
                        {/* Data */}
                    </div>
                </div>
            </div>
        );
    }
}

export default Block;