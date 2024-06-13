import React, { Component } from 'react';
import { getMinistry } from '../../../helper/ministryHelper';
import { getCategories } from "../../../helper/ministryHelper";
import { socialShare } from "../../../helper/helper";
import { Link } from 'react-router-dom';
import Detailchart from './Detailchart';
import Related from './Related';

class Content extends Component {
    constructor(props) {
        super(props);
        this.openSocialPopup = this.openSocialPopup.bind(this);
    }
    // Open window
    openSocialPopup(social) {
        window.open(social.link, "MsgWindow", "width=600,height=600")
        // alert(social.title)
    }
    render() {
        const detailId = this.props.detailId;
        const item = getMinistry(detailId);
        return (
            <div className="section">
                <div className="container">
                    <div className="entry-content">
                        {getCategories(item.category).slice(0, 1).map((cat, i) => (
                            <span className="fw-600 custom-primary text-uppercase" key={i}>{cat.title}</span>
                        ))}
                        <h3 className="entry-title">{item.title}</h3>
                        <div className="sigma_post-single-thumb">
                            <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} className="w-100" />
                            <div className="sigma_box">
                                <div className="sigma_list-item">
                                    <label>Ministry:</label>
                                    <span>{item.title}</span>
                                </div>
                                <div className="sigma_list-item">
                                    <label>Date:</label>
                                    <span>{item.postdate}</span>
                                </div>
                                <div className="sigma_list-item">
                                    <label>Category:</label>
                                    {getCategories(item.category).slice(0, 1).map((cat, i) => (
                                        <span key={i}>{cat.title}</span>
                                    ))}
                                </div>
                                <div className="sigma_list-item">
                                    <ul className="sigma_sm">
                                        {/* Data */}
                                        {socialShare(item.title).map((social, i) => (
                                            <li key={i}>
                                                <Link to="#" onClick={(e) => this.openSocialPopup(social, i)}>
                                                    <i className={social.iconClass} />
                                                </Link>
                                            </li>
                                        ))}
                                        {/* Data */}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <p>{item.shorttext}</p>
                        <Detailchart />
                        <div dangerouslySetInnerHTML={{ __html: item.htmltext }} />
                        <div className="row">
                            {/* Dta */}
                            {item.gallery.map((image, i) => (
                                <div className="col-md-4" key={i}>
                                    <a rel={"external"} href={process.env.PUBLIC_URL + "/" + image} className="gallery-thumb">
                                        <img src={process.env.PUBLIC_URL + "/" + image} alt={item.title} />
                                    </a>
                                </div>
                            ))}
                            {/* Dta */}
                        </div>
                        <Related />
                    </div>
                </div>
            </div>
        );
    }
}

export default Content;