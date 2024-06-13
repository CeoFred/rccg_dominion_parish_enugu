import React, { Component, Fragment } from 'react';
import Quotecta from '../../layouts/Quotecta';
import { getVolunteer } from '../../../helper/volunteerHelper';

class Content extends Component {
    render() {
        const detailId = this.props.detailId;
        const item = getVolunteer(detailId);
        return (
            <Fragment>
                <div className="section sigma_post-single">
                    <div className="container">
                        <div className="row">
                            <div className="col-12">
                                <div className="entry-content">
                                    <div className="sigma_volunteer-detail mb-5">
                                        <div className="row">
                                            <div className="col-lg-5">
                                                <div className="sigma_member-image style-1">
                                                    <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.name} className="mb-0" />
                                                </div>
                                            </div>
                                            <div className="col-lg-7">
                                                <div className="sigma_volunteer-detail-inner mt-5 mt-lg-0 ps-0 ps-lg-4">
                                                    <h3 className="sigma_member-name">{item.name}</h3>
                                                    <span className="sigma_volunteer-detail-category">{item.post}</span>
                                                    <ul className="sigma_volunteer-detail-info">
                                                        {/* Data */}
                                                        {item.contactinfo.map((data, i) => (
                                                            <li key={i}>
                                                                <i className={data.icon} />
                                                                <span className="title">{data.title}:</span>{data.text}
                                                            </li>
                                                        ))}
                                                        {/* Data */}
                                                    </ul>
                                                    <ul className="sigma_volunteer-detail-info">
                                                        {/* Data */}
                                                        {item.social.map((data, i) => (
                                                            <li key={i}>
                                                                <i className={data.icon} />
                                                                <span className="title">{data.title}:</span><a rel={"external"} href={data.text + "/" + item.name}>{data.text}/{item.name}</a>
                                                            </li>
                                                        ))}
                                                        {/* Data */}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4>About {item.name}</h4>
                                    <div dangerouslySetInnerHTML={{ __html: item.htmltext }} />
                                    <hr />
                                    <h4>Skills</h4>
                                    <div className="row">
                                        <div className="col-lg-6">
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                                            </p>
                                            <p className="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                        </div>
                                        <div className="col-lg-6">
                                            <div className="mt-4 mt-lg-0">
                                                {/* Data */}
                                                {item.skills.map((data, i) => (
                                                    <div className="sigma_progress" key={i}>
                                                        <h6>{data.title}</h6>
                                                        <span className="sigma_progress-count" style={{ left: data.value + "%" }}>{data.value}%</span>
                                                        <div className="progress">
                                                            <div className="progress-bar" style={{ width: data.value + "%" }}>
                                                                <span />
                                                                <span />
                                                            </div>
                                                        </div>
                                                    </div>
                                                ))}
                                                {/* Data */}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <Quotecta />
            </Fragment>
        );
    }
}

export default Content;