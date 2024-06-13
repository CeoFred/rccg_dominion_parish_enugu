import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { getRecentPost } from "../../../helper/blogHelper";

class Blogs extends Component {
    render() {
        return (
            <div className="section section-padding pt-0">
                <div className="container">
                    <div className="section-title section-title-2 text-center">
                        <p className="subtitle">Blog</p>
                        <h4 className="title">Church News Feed</h4>
                    </div>
                    <div className="row">
                        {/* Article Start */}
                        {getRecentPost().map((item, i) => (
                            <div className="col-lg-4 col-md-6" key={i}>
                                <article className="sigma_post style-2">
                                    <div className="sigma_post-thumb">
                                        <Link to={"/blog-details/" + item.id}>
                                            <img src={process.env.PUBLIC_URL + "/" + item.image[0]} alt={item.title} />
                                        </Link>
                                    </div>
                                    <div className="sigma_post-body">
                                        <div className="sigma_post-meta">
                                            <Link to={"/blog-details/" + item.id} className="sigma_post-date"> <i className="far fa-calendar" /> {item.postdate}</Link>
                                        </div>
                                        <h5> <Link to={"/blog-details/" + item.id}>{item.title}</Link> </h5>
                                    </div>
                                </article>
                            </div>
                        ))}
                        {/* Article End */}
                    </div>
                </div>
            </div>
        );
    }
}

export default Blogs;