import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { getRecentPost } from "../../../helper/blogHelper";
import { getAuthor, getTags } from "../../../helper/helper";

class Blogs extends Component {
    render() {
        return (
            <div className="section section-padding pt-0">
                <div className="container">
                    <div className="section-title text-center">
                        <p className="subtitle">Blog</p>
                        <h4 className="title">News Feed</h4>
                    </div>
                    <div className="row">
                        {/* Article Start */}
                        {getRecentPost().map((item, i) => (
                            <div className="col-lg-4 col-md-6" key={i}>
                                <article className="sigma_post">
                                    <div className="sigma_post-thumb">
                                        <Link to={"/blog-details/" + item.id}>
                                            <img src={process.env.PUBLIC_URL + "/" + item.image[0]} alt={item.title} />
                                        </Link>
                                    </div>
                                    <div className="sigma_post-body">
                                        <div className="sigma_post-meta">
                                            <div className="me-3">
                                                <i className="far fa-cross" />
                                                {/* Data */}
                                                {getTags(item.tags).slice(0, 2).map((tag, i) => (
                                                    <Link to={"/blog/tag/" + tag.id} className="sigma_post-category" key={i}>{tag.title}</Link>
                                                ))}
                                                {/* Data */}
                                            </div>
                                            <Link to={"/blog-details/" + item.id} className="sigma_post-date"> <i className="far fa-calendar" />{item.postdate}</Link>
                                        </div>
                                        <h5> <Link to={"/blog-details/" + item.id}>{item.title}</Link> </h5>
                                        {getAuthor(item.author).map((author, i) => (
                                            <div className="sigma_post-single-author" key={i}>
                                                <img src={process.env.PUBLIC_URL + "/" + author.image} alt={author.name} />
                                                <div className="sigma_post-single-author-content">
                                                    By <p>{author.name}</p>
                                                </div>
                                            </div>
                                        ))}
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