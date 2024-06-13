import React, { Component, Fragment } from 'react';
import { Link } from 'react-router-dom';
import { getNextSermon } from "../../../helper/sermonHelper";
import { getAuthor } from "../../../helper/helper";
import Plyr from "plyr-react";

const audioSources = {
    type: "audio",
    sources: [
        {
            src: 'https://cdn.plyr.io/static/demo/Kishi_Bashi_-_It_All_Began_With_a_Burst.mp3',
            type: 'audio/mp3',
        }
    ]
};

class Nextsermon extends Component {
    render() {
        return (
            <Fragment>
                {getNextSermon().slice(0, 1).map((item, i) => (
                    <div className="sigma_sermon-box" key={i}>
                        <div className="sigma_box">
                            <span className="subtitle">Latest Sermons</span>
                            <h4 className="title mb-0">
                                <Link to={"/sermon-details/" + item.id}>{item.title}</Link>
                            </h4>
                            <ul className="sigma_sermon-info mb-0">
                                {getAuthor(item.author).map((author, i) => (
                                    <li key={i}>
                                        <i className="far fa-user" />
                                        Message From
                                        <Link to={"/sermon/author/" + author.id} className="ms-2"><u>{author.name}</u></Link>
                                    </li>
                                ))}
                                <li className="mt-0 ms-4">
                                    <i className="far fa-calendar-check" />
                                    {item.sermondate}
                                </li>
                            </ul>
                            <ul className="sigma_sm square">
                                {/* Data */}
                                {item.social.map((social, i) => (
                                    <li key={i}>
                                        <a rel={"external"} href={social.url}>
                                            <i className={social.icon} />
                                        </a>
                                    </li>
                                ))}
                                {/* Data */}
                            </ul>
                            <div className="sigma_audio-player">
                                <Plyr source={audioSources} />
                            </div>
                        </div>
                    </div>
                ))}
            </Fragment>
        );
    }
}

export default Nextsermon;