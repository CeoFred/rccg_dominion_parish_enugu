import React, { Component } from 'react';
import locationmap from "../../../data/locationmap.json";
import { getAuthor } from "../../../helper/helper";

class Locationmap extends Component {
    render() {
        return (
            <div className="section d-none d-lg-block p-0">
                <div className="container">
                    <img src="assets/img/textures/map.png" alt="map" />
                    <div className="map-markers">
                        {/* Data */}
                        {locationmap.map((item, i) => (
                            <div key={i} className={"map-marker " + item.position}>
                                {item.image === true ? '' : <span />}
                                {getAuthor(item.author).map((author, i) => (
                                    <img src={process.env.PUBLIC_URL + "/" + author.image} alt={author.name} key={i} />
                                ))}
                                <div className="map-marker-content">
                                    <p>{item.text}</p>
                                    {getAuthor(item.author).map((author, i) => (
                                        <span key={i}>
                                            <b className="text-white">{author.name}</b> / <b className="custom-primary">{author.post}</b>
                                        </span>
                                    ))}
                                </div>
                            </div>
                        ))}
                        {/* Data */}
                    </div>
                </div>
            </div>
        );
    }
}

export default Locationmap;